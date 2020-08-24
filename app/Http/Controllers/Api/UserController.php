<?php

namespace App\Http\Controllers\Api;

use App\Events\ProfileUpdate;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileRequest;
use App\Imports\UsersImport;
use App\Mail\NewUser;
use App\Models\Activity;
use App\Models\Reward;
use App\Models\Setting;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $search = $request->get('search');

        if (is_null($search)) {
            $users = User::query();
        } else {
            $users = $users->where('name', 'LIKE', '%' . $search . '%');
        }

        $users->with('roles', 'permissions')->latest();
        return response()->paginate($users);
    }

    public function import(Request $request)
    {
        Excel::import(new UsersImport(), request()->file('file'));

        return response()->success('common.success');
    }

    public function export(Request $request)
    {
        $file = Excel::download(new UsersExport(), 'users.csv', \Maatwebsite\Excel\Excel::CSV);
        $linkTarget = $file->getFile()->getLinkTarget();
        return response()->success($linkTarget);
    }

    public function getMe(Request $request)
    {
        $user_id = $request->user()->id;
        $level_ids = Level::getUserLevelIds($user_id);

        $role = $request->role;
        if (!is_null($role)) {
            $users = User::role($role)->with('image')->get();
            return response()->success($users);
        }
        $user = User::where('id', $user_id)
            ->with('image',
                'classroom',
                'roles',
                'permissions')
            ->with(['levels' => function ($q) use ($level_ids) {
                $q->whereIn('level_id', $level_ids);
            }])->first();
        //FIXME: chnage classroom image
        $classroom = $user->classroom()->first();
        $avatar = $user->avatar()->first();

        if ($avatar) {
            $user->posture_no = $avatar->posture;
        }

        if ($classroom) {
            $user->class_room_image = Image::where(['imageable_id' => $classroom->id, 'imageable_type' => Classroom::class])->get();
        }
        return response()->success($user);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->error('error.not-found');
        }

        return response()->success($user->load('roles', 'permissions', 'levels', 'image'));
    }

    //Get history of question that asked to user
    public function getAskedQuestion(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $models = $user->questions()->withTranslation()->with('answers.translations')->get();

        return response()->success($models);
    }

    public function getClassrooms($id)
    {
        $user = User::findOrFail($id);
        $classroom = $user->classroom->load('image');

        return response()->success($classroom);
    }

    public function classmate($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->error('user.not-found');
        }
        if (is_null($user->classroom) || $user->classroom->count() == 0) {
            return response()->error('classroom.not-found');
        }
        //return response()->success($user->classroom->first()->members()->select('id', 'name', 'email', 'level')->with('image')->get());
        return response()->success($user->classroom->first()->members()->with('image')->get());
    }

    public function destroy($id)
    {
        User::findOrFail($id);
        User::destroy($id);
        return response()->success('common.success');
    }

    //Admin update
    public function update(ProfileRequest $request, $id)
    {
        $data = $request->input();
        unset($data['username']);
        unset($data['email']);

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }
        $user = User::findOrFail($id);
        $user->update($data);

        if ($request->has('roles')) {
            //Change user role
            $user->roles()->detach();
            foreach ($request->roles as $role) {
                $user->assignRole($role);
            }
        }

        if ($request->has('permissions')) {
            //Change user permissions
            $user->permissions()->detach();
            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }

        /* //Change role
         if($user->levels){
             $user->levels()->detach();
             foreach ($request->levels as $key => $level){
                 $user->levels()->attach($level,  [ 'current_xp' => $request->current_xp[$key]]);
             }
         }*/

        //Add image
        if ($request->hasFile('image')) {
            $user->image()->delete();
            $user->image()->save(new Image([
                'image' => $request->file('image'),
            ]));
        }
        event(new ProfileUpdate($request, $user));
        //event(new UserUpdate($request));

        return response()->success('common.success');
    }

    public function getAvatar()
    {
        //FIXME: change here to auth()->user()
        $user = User::find(1);
        $avatar = $user->avatar;
        $avatar->gender = $user->gender;


        return response()->success($avatar);
    }

    public function saveAvatarConfiguration(Request $request)
    {
        //FIXME: change here to auth()->user()
        $user = User::find(1);
        $avatar = $user->avatar;
        $avatar->update($request->input());

        return response()->success($avatar);
    }

    // For User
    public function updateActivityStatus(Request $request, $id)
    {
        $activity = Activity::find($id);
        if (!$activity) {
            return response()->error('activity.not-found');
        }

        $status = Status::find($request->status_id);

        if (!$status) {
            return response()->error('error.not-found');
        }

        $activity->users()->updateExistingPivot(auth()->user(), ['status_id' => $status->id]);

        return response()->success('common.success');
    }

    public function getAllUsers(Request $request)
    {
        $role = $request->role;
        if (is_null($role)) {
            return response()->error('role.not-found');
        }
        $users = User::role($role)->with('image', 'classroom.school.campus');
        return response()->paginate($users);
    }

    //Get student rewards
    public function getRosettes(Request $request, $user_id)
    {

        $user = User::findOrFail($user_id);
        auth()->login($user);
        return response()->success($user->rosettes());
    }

    public function getMedals(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        auth()->login($user);
        return response()->success($user->medals());
    }

    public function getBadges(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        return response()->success($user->Badges());
    }

    public function getUserSurvey(Request $request)
    {

        $user = $request->user();
        $models = $user->surveys()->with('answers', 'categories')->get();

        return response()->success($models);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'user_activity')->whithivot('status');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'user_reward');
    }

    //Admin run demo data on selected user
    public function runDemoData(Request $request)
    {

        $user = User::findOrFail($request->user_id);

        event(new \App\Events\UserCreated($user));
        $user->assignRole(\App\Models\Role::findByName(\App\Models\Setting::ROLE_STUDENT, 'web'));
        $user->classroom()->sync(Classroom::find(1));

        $user->setArtifactStatus(Setting::ARTIFACT_CLUB, 1);
        $user->setArtifactStatus(Setting::ARTIFACT_PROJECT, 1);
        $user->setArtifactStatus(Setting::ARTIFACT_TASK, 1);
        $user->setArtifactStatus(Setting::ARTIFACT_QUESTION_ANSWER, 1);
        $user->setArtifactStatus(Setting::ARTIFACT_GENERAL, 1);

        $user->setCurrentXp(Setting::ARTIFACT_PROJECT, 1, 140);
        $user->setCurrentXp(Setting::ARTIFACT_CLUB, 1, 120);
        $user->setCurrentXp(Setting::ARTIFACT_TASK, 1, 80);
        $user->setCurrentXp(Setting::ARTIFACT_QUESTION_ANSWER, 1, 50);
        $user->setCurrentXp(Setting::ARTIFACT_GENERAL, 1, 700);

        $user->introductions()->attach(Introduction::inRandomOrder()->first(), ['is_completed' => 1]);

        if ($user->gender == 1) {
            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
            ]));
        } else {
            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/female/female1.png")),
            ]));
        }
        /// Add project to user
        foreach (Project::all() as $project) {
            $project->members()->attach($user, ['is_member' => 1, 'status' => rand(0, 3)]);
        }
        /// Add club to user
        foreach (Club::take(1)->get() as $club) {
            $club->members()->attach($user, ['is_member' => 1]);
        }
        /// Add task to user
        foreach (Task::all() as $task) {
            $task->members()->attach($user, ['status' => rand(0, 3)]);
        }
        /// Add question to user
        foreach (Question::inRandomOrder()->take(5)->get() as $question) {
            $user->questions()->attach($question);
        }
        /// Add profile to use
        $user->profile->claims()->attach(User::skip(1)->take(20)->get(), ['is_friend' => true]);
        $user->profile->tags()->attach(rand(1, 5));

        $medals = Medal::whereIn('id', [2, 3, 5, 10, 11, 12])->get();
        $rosettes = Rosette::whereIn('id', [5, 8, 12, 15])->get();
        $badges = Badge::whereIn('id', [1])->get();

        $user->profile->medals()->sync($medals);
        $user->profile->rosettes()->sync($rosettes);
        $user->profile->badges()->sync($badges);

        //Send notify email
        try {
            $when = now()->addSecond(1);
            Mail::to($user->email)
                ->cc('javad.fathi@sarente.com')
                //->later($when, new NewUser($user));
                ->send(new NewUser($user));

            return response()->success('common.success');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return response()->success('common.success');
    }
}
