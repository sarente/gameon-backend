<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UserModelNotFoundException;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    public function index()
    {
        $user = User::getUser();

        $categories = $user->levels->load('image','category')->map();

        return response()->success($categories);
    }

    public function store(Request $request)
    {
        $model = new Category($request->input());
        $model->save();

        return response()->success('common.success');
    }

    public function show($id){
        //FIXME: change here to auth()->user()
        $user_id = 1;
        $category = Category::with('users')->find($id);
        $workflows = User::find($user_id)->workflows()->where('category_id', $id)->get();

        $category->workflows = $workflows;

        return response()->success($category);
    }

    public function syncUsers(Request $request, $id) {
        $category = Category::find($id);

        $users = User::find($request->user_ids);
        $category->users()->sync($users);

        return response()->success($category);
    }

}
