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
