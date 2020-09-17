<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $lang=app()->getLocale();
        $result = collect();
        $user = User::getUser();

        $categories = Category::query();
        $levels = Level::query();

        // ["category_id": 1,"current_point": "50"],...
        $user_category_points = $user->pointsByCategory()->toArray();

        //Get level by point of category
        foreach ($categories->pluck('id')->toArray() as $key => $value) {

            for ($i = 0; $i < count($user_category_points); $i++) {

                if (!is_null($user_category_points[$i]['category_id']) && $user_category_points[$i]['category_id'] == $value){
                    //Get max point of each level { "id": 10,"level_no": 4,"max_point": 800,"category_id": 2}},....
                    $levels = Level::where('category_id', $value);

                    if ($levels->exists()) {
                        //Check $usr_cat_pnt['current_point'] in
                        $slected_level = $this->getLevelOfUserByPoint($user_category_points[$i]['current_point'], $levels->get()->toArray());

                        //sort data of array
                        $slected_level['current_point']=(int)$user_category_points[$i]['current_point'];
                        $slected_level['level_id']=$slected_level['id'];
                        $slected_level['category_name']=Category::find($slected_level['category_id'])->translations['name'][$lang];
                        unset($slected_level['id']);

                        $result->push($slected_level);
                    }
                }else{
                    //TODO:If user has any point in specific category
                    //$result->push([$user_category_points[$i], $slected_level]);
                }

            }
        }
        //{'category_id','level_no','current_point','max_point'}

        return response()->success($result);
    }

    public
    function store(Request $request)
    {
        $model = new Category($request->input());
        $model->save();

        return response()->success('common.success');
    }

    public
    function show($id)
    {
        //FIXME: change here to auth()->user()
        $user_id = 1;
        $category = Category::with('users')->find($id);
        $workflows = User::find($user_id)->workflows()->where('category_id', $id)->get();

        $category->workflows = $workflows;

        return response()->success($category);
    }

    public
    function syncUsers(Request $request, $id)
    {
        $category = Category::find($id);

        $users = User::find($request->user_ids);
        $category->users()->sync($users);

        return response()->success($category);
    }

    private
    function getLevelOfUserByPoint($current_point, $levels)
    {
        //Get level data bu current point user
        $result = [];
        foreach ($levels as $level) {
            if ($current_point >= $level['max_point']) {
                $result[] = $level;
            }
        }
        $len = count($result);
        $index = $len > 0 ? $len - 1 : 0;
        return $result[$index];
    }

}
