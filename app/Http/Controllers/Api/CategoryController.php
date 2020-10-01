<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Level;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserWorkflow;


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

                    //Calculate next level point
                    $calc_next_level = $slected_level['level_no'] + 1;
                    $next_level = $calc_next_level > 5 ? 5 : $calc_next_level;
                    $next_level_point = Level::whereHas('category', function ($cat) use ($value) {
                        $cat->where('id', $value);
                    })->where('level_no', $next_level)->first()->level_point;

                    //sort data of array
                    $slected_level['current_point'] = (int)$user_category_points[$key]['current_point'];
                    $slected_level['next_level_point'] = $next_level_point;
                    //$slected_level['level_id']=$slected_level['id'];
                    $slected_level['category_name'] = $category_name;
                    unset($slected_level['id']);
                    unset($next_level_point);
                    $result->push($slected_level);
                }
            } else {
                $next_level_point = Level::whereHas('category', function ($cat) use ($value) {
                    $cat->where('id', $value);
                })->where('level_no', 1)->first()->level_point;
                $null_poin_category = [
                    "level_no" => 0,
                    "level_point" => 0,
                    "next_level_point" => $next_level_point,
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
        $user = User::getUser();

        $category = Category::find($id);

        $workflows = UserWorkflow::where('user_id', $user->id)
            ->where('category_id', $id)
            ->join('workflows', 'user_workflow.workflow_id', '=', 'workflows.id')
            ->get();

        foreach($workflows as $workflow) {
            $config = json_decode($workflow->config);
            $workflow->title = $config->metadata->title;
            unset($workflow->config);
        }

        $user_category_points = $user->pointsByCategory()->firstWhere('category_id', $id);
        //dd($user_category_points);

        $levels = Level::where('category_id', $id);
        if ($levels->exists() && $user_category_points) {

            //Check $usr_cat_pnt['current_point'] in
            $slected_level = $this->getLevelOfUserByPoint($user_category_points->current_point, $levels->get()->toArray());

            //Calculate next level point
            $last_level=getByKey(Setting::LAST_LEVEL);
            $calc_next_level = $slected_level['level_no'] + 1;
            $next_level = $calc_next_level > $last_level ? $last_level : $calc_next_level;
            $next_level_point = Level::whereHas('category', function ($cat) use ($id) {
                $cat->where('id', $id);
            })->where('level_no', $next_level)->first()->level_point;

            //sort data of array
            $slected_level['current_point'] = (int)$user_category_points->current_point;
            $slected_level['next_level_point'] = $next_level_point;
            unset($slected_level['id']);
            unset($next_level_point);
            $level_info = $slected_level;
        }
        else {
            $next_level_point = Level::whereHas('category', function ($cat) use ($id) {
                $cat->where('id', $id);
            })->where('level_no', 1)->first()->level_point;
            $level_info = [
                "level_no" => 0,
                "level_point" => 0,
                "next_level_point" => $next_level_point,
                "current_point" => 0,
            ];
        }

        $category->level_info = $level_info;
        $category->workflows = $workflows;

        return response()->success($category);
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
