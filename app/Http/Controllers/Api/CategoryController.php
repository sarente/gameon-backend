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
        $result = collect();
        $user = User::getUser();

        $categories = Category::with('levels');

        // ["category_id": 1,"current_point": "50"],...
        $user_category_points = $user->pointsByCategory()->toArray();

        //Get level by point of category
        foreach ($user_category_points as $usr_cat_pnt) {
            //Get max point of each level { "id": 10,"level_no": 4,"max_point": 800,"category_id": 2}},....
            $levels = $categories->where('id', (int)$usr_cat_pnt['category_id']);
            if($levels->exists()){
                $slected_level = $this->getLevelOfUserByPoint($usr_cat_pnt['current_point'], $levels->first()->levels->toArray());
                $result->push([$usr_cat_pnt, $slected_level]);
            }
            $result->push([$usr_cat_pnt, null]);
        }
        //{'category_id','level_no','current_point','max_point'}

        return response()->success($result);
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

    private function getLevelOfUserByPoint($current_point, $levels)
    {
        //Get level data bu current point user
        $result = [];
        foreach ($levels as $level) {
            if ($current_point > $level['max_point']) {
                $result[] = $level;
            }
        }
        $len = count($result);
        $index = $len > 0 ? $len - 1 : 0;
        return $result[$index];
    }

}
