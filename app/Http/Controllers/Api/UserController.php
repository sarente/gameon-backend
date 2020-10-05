<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPoint;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::getUser();

        return response()->success($user->load('image'));
    }

    public function show($id)
    {
        $user = USer::getUser();

        return response()->success($user->load('rewards', 'image', 'roles', 'permissions'));
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

    public function result()
    {
        $user = User::getUser();
        $point=(int)UserPoint::where('user_id', $user->id)->sum('point');
        $user->points = $point < 0 ?0 : $point;
        $user->load('rewards.image');
        return response()->success($user);
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
