<?php

namespace App\Database\Seeds\Demo;

use App\Models\Result;
use App\Models\Reward;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Result::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $activities = [

        ];

        foreach ($activities as $key => $activity) {
            $activity = Result::create([
                'name' => $activity,
                'type' => Setting::$activity_types[1],
                'point' => 75,
            ]);

            if ($key == 0) {
                $activity->metadata = ['param1'=>'güç birliği'];
            } else if ($key == 1) {
                $activity->metadata = ['param1'=>'iyi niyet'];
                $activity->rewards()->syncWithoutDetaching(Reward::find($key));
            } else if ($key == 2) {
                $activity->metadata = ['param1'=>'analitik bakış açısına sahip olmak'];
                $activity->point=100;
                $activity->rewards()->syncWithoutDetaching(Reward::find($key));
            }
            $activity->save();
        }
    }
}