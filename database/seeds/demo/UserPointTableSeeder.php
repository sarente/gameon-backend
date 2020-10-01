<?php
namespace App\Database\Seeds\Demo;
use Illuminate\Database\Seeder;

class UserPointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\UserPoint::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // {"en": "Values", "tr": "Değeler"} //wvf: values
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            //'result_id'=> 1,
            //'workflow_id'=> 1,
            'category_id'=> 1,
            'point' => 15
        ]);

        //{"en": "Competence", "tr": "Yetkinlikler"} //wvf: base_competence
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            //'result_id'=> 1,
            //'workflow_id'=> 2,
            'category_id'=> 2,
            'point' => 15
        ]);
        //wvf: management_competence
/*        \App\Models\UserPoint::create([
            'user_id'=> 2,
            //'result_id'=> 1,
            //'workflow_id'=> 3,
            'category_id'=> 2,
            'point' => 15
        ]);
        //wvf: high_level_competence
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            //'result_id'=> 1,
            //'workflow_id'=> 4,
            'category_id'=> 2,
            'point' => 15
        ]);

        //{"en": "Entertainment", "tr": "Eğlence"}  //wvf: entertainment
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            //'result_id'=> 1,
            //'workflow_id'=> 5,
            'category_id'=> 3,
            'point' => 15
        ]);*/

    }
}
