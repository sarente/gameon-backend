<?php

namespace App\Database\Seeds\Demo;
use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ActivityTableSeeder extends Seeder
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
        \App\Models\Activity::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $activities = ['ACTIVITY_RETURN1','ACTIVITY_ACTION1', 'ACTIVITY_ACTION2' ];

        foreach ($activities as $key => $activity) {
            $act_type=Setting::$activity_types[0];
            if($key==0)  {
                $act_type=Setting::$activity_types[1];
            }
            $activity = new Activity([
                'name' => $activity,
                'type' => $act_type,
                'point' =>  rand(10,100),
            ]);
            $activity->save();
        }
    }
}
