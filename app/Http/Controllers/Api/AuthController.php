<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

//use App\Models\Social;
//use App\Socialite\GoogleIdProvider;
//use Intervention;
//use Laravel\Socialite\AbstractUser;
//use Laravel\Socialite\Facades\Socialite;
//use Laravel\Socialite\Two\GoogleProvider;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $emailExists = User::whereEmail($request->input('email'))->exists();

        if ($emailExists) {
            return response()->error('auth.register.email-exists',[],[],400);
        }
        $user = new User();
        $user->fill([
            'name'=>$request['name'],
            'surname'=>$request['surname'],
            'email'=>$request['email'],
            'gender'=>$request['gender'],
            'username'=>$request['username'] ?? rand(00000000000, 99999999999),
            'password'=>Hash::make($request['password']),
        ]);
        $user->save();
        //Login user
        auth()->setUser($user);

        //FIXME: check external users
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

    public function login(Request $request, Guard $auth)
    {
        $credentials = $request->only('email', 'password');

        if (!$auth->validate($credentials)) {
            return response()->error('auth.invalid');
        }
        $user = $auth->user();

        return $this->respondWithToken($user);
    }

    public function me(Guard $auth)
    {
        return response()->success($auth->user());
    }

    public function logout(Guard $auth)
    {
        $auth->logout();
        return response()->message('auth.logout');
    }

    protected function respondWithToken($user)
    {
        $token = (new Builder())
            ->issuedAt(time())
            ->expiresAt(time() + 365 * 24 * 60 * 60)
            //->expiresAt(time() + config('jwt.ttl')* 60)
            ->issuedBy($user->username)
            ->relatedTo($user->id)
            ->withClaim('eml',$user->email)
            ->getToken(new Sha256(), (new Keychain())->getPrivateKey(config('jwt.private'), config('jwt.passphrase')));

        return response()->success([
            'token' => $token->__toString(),
        ]);
    }
}
