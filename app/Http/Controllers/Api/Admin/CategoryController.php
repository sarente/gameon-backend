<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if (!$categories) {
            return response()->error('error.not-found');
        }
        return response()->success($categories);
    }

    public function store(CategoryRequest $request)
    {
        $data=$request->json()->all();
        $model = new Category($data);
        $model->save();

        return response()->success($model);
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
