<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $search = $request->get('search');

        if (is_null($search)) {
            $users = User::query();
        }
        else {
            $users = $users->where('name', 'LIKE', '%' . $search . '%');
        }

        $users->latest();
        return response()->success($users->get());
    }

    public function show($id)
    {
       $user=USer::getUser();

        return response()->success($user->load('image', 'roles', 'permissions'));
    }

    public function destroy($id)
    {
        User::findOrFail($id);
        User::destroy($id);
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
        $user = User::find(1);
        $avatar = $user->avatar;
        $data=json_decode($request->items, true);
        $avatar->items = $data;
        $avatar->save();
    }

}
