<?php

namespace App\Http\Controllers\Api\Admin;

use App\Exceptions\UserIsValidException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $users->latest();
        return response()->success($users->get());
    }

    public function show($id)
    {
        $user = User::getUser($id);

        return response()->success($user->load('image', 'roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $req = $request->json();

        if (!$req->has('email')) {
            throw new UserIsValidException();
        }
        //Check user is valid in DB
        $valid_user = User::whereEmail($req->get('email'))->exists();

        if ($valid_user) {
            throw new UserIsValidException();
        }
        $user = new User();
        $user->email = $req->get('email');
        $user->name = $req->get('name');
        $user->surname = $req->get('surname');
        $user->username = $req->get('username') ?? rand(00000000000, 99999999999);
        $user->gender = $req->get('gender') ?? Setting::GENDER_MALE;
        $user->password = Hash::make($req->get('password'));
        $user->save();

        $user->assignRole(Setting::ROLE_USER);

        return response()->success('common.success');
    }

    public function destroy($id)
    {
        //Todo: check if its admin
        $user = User::getUser($id);
        if ($user->hasRole(Setting::ROLE_ADMIN)) {
            return response()->erorr('admin.couldnt-remove');
        }
        $user->destroy($id);
        return response()->success('common.success');
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::getUser($id);
        $user->update($request->json()->all());
        return response()->success('common.success');
    }

    public function saveAvatarConfiguration(Request $request)
    {
        $user = User::find(1);
        $avatar = $user->avatar;
        $data = json_decode($request->items, true);
        $avatar->items = $data;
        $avatar->save();
    }

}
