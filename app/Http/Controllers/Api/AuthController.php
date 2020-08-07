<?php

namespace App\Http\Controllers\Api;

use App\Events\IntroAssign;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\Request;
use App\Models\Image;
use App\Models\PasswordReset;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Social;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//use App\Socialite\GoogleIdProvider;
//use Intervention;
//use Laravel\Socialite\AbstractUser;
//use Laravel\Socialite\Facades\Socialite;
//use Laravel\Socialite\Two\GoogleProvider;

use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $user = new User($request->except('role'));

        $emailExists = User::whereEmail($request->input('email'))->exists();

        if ($emailExists) {
            return response()->error('auth.register.email-exists');
        }

        //Detect role of user
        $role = Role::where('name', Setting::ROLE_STUDENT)->firstOrFail();

        if (!is_null($request->role) && $request->role==Setting::ROLE_TEACHER) {
            $role = Role::where('name', Setting::ROLE_TEACHER)->firstOrFail();
        }
        $user->assignRole($role);

        $user->username = rand(00000000000, 99999999999);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $provider = $request->input('provider');
        $token = $request->input('token');

        if ($provider && $token) {
            try {
                /** @var \Laravel\Socialite\AbstractUser $socialUser */
                if ($provider == 'facebook') {
                    $socialUser = Socialite::driver($provider)
                        ->scopes(['email', 'user_gender', 'user_birthday'])
                        ->fields(['name', 'email', 'birthday', 'verified'])
                        ->userFromToken($token);
                } else if ($provider == 'google') {
                    /** @var GoogleProvider $socialite */
                    $socialUser = Socialite::driver($provider)
                        ->userFromToken($token);

                } else if ($provider == 'googleid') {
                    /** @var GoogleIdProvider $socialite */
                    $socialUser = Socialite::driver($provider)
                        ->userFromToken($token);
                    $provider = 'google';
                } else {
                    throw new \Exception();
                }
                /** @var AbstractUser $socialUser */

                // Attach social profile
                $social = new Social([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'access_token' => $token,
                ]);
                $social->user()->associate($user);
                $social->save();

            } catch (\Exception $e) {
                // Ignore error
            }

            // Attach Image
            try {
                if ($socialUser && $socialUser->getAvatar()) {
                    $user->image()->save(new Image([
                        'image' => Intervention::make($socialUser->getAvatar()),
                    ]));
                }
            } catch (\Exception $e) {
                // Ignore error
            }
        }

        return $this->respondWithToken($user);
    }

    public function login(LoginRequest $request, Guard $auth)
    {
        $auth->once([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ]);
        if ($request->email) {
            $auth->once([
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ]);
        }

        /** @var User $user */
        $user = $auth->user();
        if (!$user) {
            return response()->error('auth.invalid');
        }
        $roleNames = $user->roles()->pluck('name', 'id')->toArray();
        $rolename = Setting::ROLE_STUDENT;

        //If user have a admin role it have to be set as admin
        if (in_array(Setting::ROLE_TEACHER, $roleNames)) {
            $rolename = Setting::ROLE_TEACHER;
        }
        if (in_array(Setting::ROLE_ADMIN, $roleNames)) {
            $rolename = Setting::ROLE_ADMIN;
        }

        //Check if user not completed intro return to introduction of gameon
        //$is_intro_completed = $user->is_intro_completed();
        //$is_intro_completed = true;//dis able on boarding
        //$url = User::getUrl($rolename, $is_intro_completed);

        //Get user task if it is valid
        //$task = $user->tasks()->orderByDesc('task_user.task_id')->first();
        return $this->respondWithToken($user, $rolename, null, null);
        //return $this->respondWithToken($user, $rolename, $url, $task);
    }

    public function logout(Request $request)
    {
        activity()
            ->causedBy($request->user())
            ->log('logged_out');
        return response()->message('auth.logout');
    }

    public function social(Request $request, $provider)
    {
        $token = $request->input('token');
        try {
            /** @var \Laravel\Socialite\AbstractUser $socialUser */
            if ($provider == 'facebook') {
                $socialUser = Socialite::driver($provider)
                    ->scopes(['email', 'user_gender', 'user_birthday'])
                    ->fields(['name', 'email', 'birthday', 'verified'])
                    ->userFromToken($token);
            } else if ($provider == 'google') {
                /** @var GoogleProvider $socialite */
                $socialUser = Socialite::driver($provider)
                    ->userFromToken($token);

            } else if ($provider == 'googleid') {
                /** @var GoogleIdProvider $socialite */
                $socialUser = Socialite::driver($provider)
                    ->userFromToken($token);
                $provider = 'google';
            } else {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'code' => 'auth.social.invalid',
                'message' => trans('errors.auth.social.invalid'),
            ], 400);
        }

        // If already logged in before
        $social = Social::whereProvider($provider)->whereProviderId($socialUser->getId())->first();

        if ($social) {
            // Update Token
            $social->access_token = $token;
            $social->save();

            return $this->respondWithToken($social->user);
        }

        // If users email address already registered
        $user = User::where('email', $socialUser->getEmail())->first();
        if ($user) {
            $social = new Social([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'access_token' => $token,
            ]);
            $social->user()->associate($user);
            $social->save();

            return $this->respondWithToken($user);
        }

        // Check Required
        $email = $socialUser->getEmail();
        $name = $socialUser->getName();
        $birthday = $socialUser->user['birthday'] ?? null;
        if ($birthday) {
            $birthday = Carbon::parse($birthday)->toDateString();
        }

        if (!$email || !$name) {
            return response()->json([
                'code' => 'auth.social.missing',
                'message' => trans('errors.auth.social.missing'),
                'user' => [
                    'token' => $token,
                    'email' => $email,
                    'name' => $name,
                    'birthday' => $birthday,
                ],
            ], 400);
        }

        if (!$user) {
            $user = new User([
                'email' => $email,
                'name' => $name,
                'birthday' => $birthday,
            ]);
            $user->save();

            //            try {
            //                if ($socialUser && $socialUser->getAvatar()) {
            //                    $user->image()->save(new Image([
            //                        'image' => Intervention::make($socialUser->getAvatar()),
            //                    ]));
            //                }
            //            } catch (\Exception $e) {
            //                // Ignore error
            //            }

            //            event(new UserRegistered($user));
        }

        $social = new Social([
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'access_token' => $token,
        ]);
        $social->user()->associate($user);
        $social->save();

        return $this->respondWithToken($user);
    }

    public function forgot(ForgotRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->error('auth.forgot.invalid');
        }

        $recentPasswordReset = PasswordReset::query()
            ->where('user_id', $user->id)
            ->where('created_at', '>', Carbon::now()->subMinutes(5))
            ->first();

        if ($recentPasswordReset) {
            return response()->error('auth.forgot.recent');
        }

        PasswordReset::create([
            'email' => $user->email,
            'user_id' => $user->id,
        ]);

        return response()->message('auth.forgot');
    }

    protected function respondWithToken($user, $rolename = null, $url = null, $task = null)
    {
        $payload = auth('api')->factory()->claims([
            'sub' => $user->id,
            'iss' => config('app.name'),
            'iat' => Carbon::now()->timestamp,
            'nbf' => Carbon::now()->timestamp,
            'jti' => uniqid(),
        ])->make();

        $token = auth('api')->manager()->encode($payload);

        activity()
            ->causedBy($user)
            ->log('logged_in');

        return response()->success([
            'token' => $token->__toString(),
            'locale' => $user->profile->language ?? App::getLocale(),
            'role' => $rolename,
            'url' => $url,
            'task' => $task,
        ]);
    }

}
