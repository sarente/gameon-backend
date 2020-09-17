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
        // {"en": "Values", "tr": "Değeler"} //wvf: values
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            'activity_id'=> 1,
            'workflow_id'=> 1,
            'category_id'=> 1,
            'point' => 450
        ]);

        //{"en": "Competence", "tr": "Yetkinlikler"} //wvf: base_competence
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            'activity_id'=> 1,
            'workflow_id'=> 2,
            'category_id'=> 2,
            'point' => 60
        ]);
        //wvf: management_competence
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            'activity_id'=> 1,
            'workflow_id'=> 3,
            'category_id'=> 2,
            'point' => 60
        ]);
        //wvf: high_level_competence
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            'activity_id'=> 1,
            'workflow_id'=> 4,
            'category_id'=> 2,
            'point' => 60
        ]);

        //{"en": "Entertainment", "tr": "Eğlence"}  //wvf: entertainment
        \App\Models\UserPoint::create([
            'user_id'=> 2,
            'activity_id'=> 1,
            'workflow_id'=> 5,
            'category_id'=> 3,
            'point' => 60
        ]);

    }
}
