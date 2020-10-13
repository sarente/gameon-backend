<?php

namespace App\Database\Seeds\Demo;

use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Intervention;

class ActivityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Activity::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //////////////////////////////////////////////////////////
        //Category Degerler Adası

        // do action
        $activity = new Activity([
            'name' => ['tr' => 'Sayfalardaki harflerin sırasını not et, bulmacayı çöz!', 'en' => 'ُPLay Slide Shows'],
            'metadata' => ['description' => ''],
            'type' => Setting::$activity_types[0],
            'kind' => Setting::$activity_kinds[0],
        ]);
        $activity->save();
        for ($i = 0; $i < 6; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order' => $i,
                'image' => Intervention::make(resource_path("images/activity/01/{$i}.jpg")),
            ]));
        }

        // return value
        $activity = new Activity([
            'name' => ['tr' => 'Kelimeyi Gir', 'en' => 'Fill in the Blanks'],
            'kind' => Setting::$activity_kinds[1],
            'type' => Setting::$activity_types[3],
            'return_value' => ['param1' => 'GÜÇ BİRLİĞİ']
        ]);
        $activity->save();

        //////////////////////////////////////////////////////////

        // do action
        $activity = new Activity([
            'name' => ['tr' => 'Sayfalardaki harflerin sırasını not et, bulmacayı çöz!', 'en' => 'ُPLay Slide Shows'],
            'metadata' => [''],
            'type' => Setting::$activity_types[0],
            'kind' => Setting::$activity_kinds[0],
        ]);
        $activity->save();
        for ($i = 0; $i < 4; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order' => $i,
                'image' => Intervention::make(resource_path("images/activity/02/{$i}.jpg")),
            ]));
        }

        // return value
        $activity = new Activity([
            'name' => ['tr' => 'Kelimeyi Gir', 'en' => 'Fill in the Blanks'],
            'metadata' => ['description' => ''],
            'kind' => Setting::$activity_kinds[1],
            'type' => Setting::$activity_types[3],
            'return_value' => ['param1' => 'İYİ NİYET']
        ]);
        $activity->save();

        ///////////////////////////////////////////////////////
        //Category Yetkinlikler Adası
        ///////////////////////////////////////////////////////

        // do action
        $activity = new Activity([
            'name' => ['tr' => 'Sayfalardaki harflerin sırasını not et, bulmacayı çöz!', 'en' => 'ُPLay Slide Shows'],
            'metadata' => ['description' => ''],
            'type' => Setting::$activity_types[0],
            'kind' => Setting::$activity_kinds[0],
        ]);
        $activity->save();
        for ($i = 0; $i < 2; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order' => $i,
                'image' => Intervention::make(resource_path("images/activity/03/{$i}.jpg")),
            ]));
        }

        // return value
        $activity = new Activity([
            'name' => ['tr' => 'Kelimeyi Gir', 'en' => 'Fill in the Blanks'],
            'metadata' => ['description' => ''],
            'kind' => Setting::$activity_kinds[1],
            'type' => Setting::$activity_types[3],
            'return_value' => ['param1' => 'ANALİTİK BAKIŞ AÇISINA SAHİP OLMAK']
        ]);
        $activity->save();
    }
}
