<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Category;
use App\Models\Pane;
use App\Models\User;
use App\Models\Workflow\UserWorkflow;
use App\Models\Workflow\Workflow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

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

    public function getMyCategories()
    {
        $user = User::find(auth()->id());

        $categories = $user->categories;

        foreach ($categories as $category) {
            $level = $category->levels()->where('level_no', $category->pivot->level_no)->first();
            $category->level = $level;
            $category->level->image = $level->image;
        }

        return response()->success($categories);

    }
}
