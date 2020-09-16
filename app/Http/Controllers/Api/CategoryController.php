<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {

        $cats= Category::with('levels')->get();
        return $cats->where('id',2)->first()->levels->where('level_no',1)->first();

        return Category::with('levels')->whereHas('levels', function ($q) {
            $q->where('levels.level_no', 2);
        })->get();

        $result = collect();
        $user = User::getUser();

        $user_category_points = $user->pointsByCategory()->toArray();

        //Get level by point of category
        foreach ($user_category_points as $key => $value) {

        }
        //{'category_id','level_no','current_point','max_point'}

        return response()->success($categories);
    }

    public function store(Request $request)
    {
        $model = new Category($request->input());
        $model->save();

        return response()->success('common.success');
    }

    public function show($id)
    {
        //FIXME: change here to auth()->user()
        $user_id = 1;
        $category = Category::with('users')->find($id);
        $workflows = User::find($user_id)->workflows()->where('category_id', $id)->get();

        $category->workflows = $workflows;

        return response()->success($category);
    }

    public function syncUsers(Request $request, $id)
    {
        $category = Category::find($id);

        $users = User::find($request->user_ids);
        $category->users()->sync($users);

        return response()->success($category);
    }

}
