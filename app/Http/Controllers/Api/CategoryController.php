<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    private $cat_level=[];

    public function index()
    {
        $result = collect();
        $user = User::getUser();
        $categories = Category::with('levels');
        $user_category_points = $user->pointsByCategory()->toArray();

        //Get level by point of category
        foreach ($user_category_points as $usr_cat_pnt) {
            //Get max point of each level
            $level=$categories->where('id', (int)$usr_cat_pnt['category_id'])->first()->levels->each(function ($elvel) use($usr_cat_pnt) {
                $this->cat_level[]=$this->getLevelOfUserByPoint($usr_cat_pnt['current_point'],$elvel);
            });
            $result->push([$usr_cat_pnt,$level]);
        }
        //{'category_id','level_no','current_point','max_point'}

        return response()->success($this->cat_level);
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
    private function getLevelOfUserByPoint($current_point,Array $levels){
        //Get level data bu current point user
        $result=[];
        foreach($levels as $level){
             if($current_point > $level->max_point){
                 $result[]=$level;
             }
        }
        $index=count($result)-1;
        return $result[$index];
    }

}
