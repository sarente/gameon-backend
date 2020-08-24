<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
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
        //FIXME: change here to auth()->user()
        $user_id = 1;
        $categories = User::find($user_id)->categories;

        if (!$categories) {
            return response()->error('error.not-found');
        }
        return response()->success($categories);
    }

    public function store(Request $request)
    {
        $category_name = $request->only('name');
        $category = Category::whereTranslationLike('name', $category_name)->exists();

        if ($category) {
            return response()->error('category.name-valid');
        }

        $model = new Category($request->input());
        $model->save();

        return response()->success('common.success');
    }

    public function show($id){
        //FIXME: change here to auth()->user()
        $user_id = 1;
        $category = Category::find($id);
        $workflows = User::find($user_id)->workflows()->where('category_id', $id)->get();

        foreach ($workflows as $workflow) {
            $activities = $workflow->activities;
            $workflow->activities = $activities;
        }

        $category->workflows = $workflows;

        return response()->success($category);
    }
}
