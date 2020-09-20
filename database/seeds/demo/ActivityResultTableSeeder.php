<?php

namespace App\Database\Seeds\Demo;

use App\Models\ActivityResult;
use App\Models\Reward;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class ActivityResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\ActivityResult::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $activities = [
            ['tr' => 'GÜÇ BİRLİĞİ', 'en' => 'union_of_forces'],
            ['tr' => 'İYİ NİYET', 'en' => 'bona_fides'],
            ['tr' => 'Analitik Bakış Açısına Sahip Olmak', 'en' => 'having_an_analytical_perspective'],

        ];

        foreach ($activities as $key => $activity) {
            $activity = ActivityResult::create([
                'name' => $activity,
                'type' => Setting::$activity_types[1],
                'point' => 100,
            ]);

            if ($key == 0) {
                $activity->metadata = ['param1'=>'GÜÇ BİRLİĞİ'];
            } else if ($key == 1) {
                $activity->metadata = ['param1'=>'İYİ NİYET'];
                $activity->rewards()->syncWithoutDetaching(Reward::find($key));
            } else if ($key == 2) {
                $activity->metadata = ['param1'=>'Analitik Bakış Açısına Sahip Olmak'];
                $activity->rewards()->syncWithoutDetaching(Reward::find($key));
            }
            $activity->save();
        }
    }
}