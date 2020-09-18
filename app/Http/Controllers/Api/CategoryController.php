<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CustomWorkflow;
use App\Models\Level;
use App\Models\User;


class CategoryController extends Controller
{
    public function index()
    {
        $lang = app()->getLocale();
        $result = collect();
        $user = User::getUser();
        $categories = Category::query();
        // ["category_id": 1,"current_point": "50"],...
        $user_category_points = $user->pointsByCategory()->toArray();
        //Get level by point of category
        foreach ($categories->pluck('id')->toArray() as $key => $value) {
            $category_name = Category::find($value)->translations['name'][$lang];
            if (array_key_exists($key, $user_category_points)
                && $user_category_points[$key]['category_id'] == $value) {
                //Get max point of each level { "id": 10,"level_no": 4,"level_point": 800,"category_id": 2}},....
                $levels = Level::where('category_id', $value);
                if ($levels->exists()) {
                    //Check $usr_cat_pnt['current_point'] in
                    $slected_level = $this->getLevelOfUserByPoint($user_category_points[$key]['current_point'], $levels->get()->toArray());
                    //sort data of array
                    $slected_level['current_point'] = (int)$user_category_points[$key]['current_point'];
                    //$slected_level['level_id']=$slected_level['id'];
                    $slected_level['category_name'] = $category_name;
                    unset($slected_level['id']);
                    $result->push($slected_level);
                }
            } else {
                $null_poin_category = [
                    "level_no" => 0,
                    "level_point" => 0,
                    "category_id" => $value,
                    "current_point" => 0,
                    "category_name" => $category_name
                ];
                $result->push($null_poin_category);
            }
        }
        return response()->success($result);
    }

    public function show($id)
    {
        $category = CustomWorkflow::whereHas('category',function($q) use ($id){
                 $q->where('categories.id',$id);
        })->get();

        return response()->success($category->load('category'));
    }

    private function getLevelOfUserByPoint($current_point, $levels)
    {
        //Get level data bu current point user
        $result = [];
        foreach ($levels as $level) {
            if ($current_point >= $level['level_point']) {
                $result[] = $level;
            }
        }
        $len = count($result);
        $index = $len > 0 ? $len - 1 : 0;
        return $result[$index];
    }

}
