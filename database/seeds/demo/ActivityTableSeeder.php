<?php

namespace App\Database\Seeds\Demo;
use App\Models\Activity;
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

        $activities = ['Activity1', 'Activity2', 'Activity3'];

        foreach ($activities as $key => $activity) {

            $activity = new Activity([
                'name' => $activity,
                'point' =>  rand(10,100),
            ]);
            $activity->save();
        }
    }
}
