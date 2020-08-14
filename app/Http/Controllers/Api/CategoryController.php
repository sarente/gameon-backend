<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
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
        $category = Category::with('types.workflows.states.activities')->find($id);
        if (!$category) {
            return response()->error('medal.not-found');
        }
        return Response::json($category);
    }
}
