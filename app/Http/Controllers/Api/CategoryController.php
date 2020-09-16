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
        return Category::find(1)->levels->map(function ($q) {
            return [
                'level_id' => $q->id,
                'max_point' => $q->max_point,
                'level_no' => $q->max_point,
            ];
        });

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
