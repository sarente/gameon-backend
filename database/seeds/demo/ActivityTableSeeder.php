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
        'name' => ['tr' => 'Slaytları İzle', 'en' => 'ُPLay Slide Shows'],
        'type' => Setting::$activity_types[0],
        'kind' => Setting::$activity_kinds[0],
    ]);
        $activity->save();
        for ($i = 0; $i < 5; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order'=>$i,
                'image' => Intervention::make(resource_path("images/activity/innovation/{$i}.jpg")),
            ]));
        }
        // return value
        $activity = new Activity([
            'name' => ['tr' => 'Kelimeyi Gir', 'en' => 'Fill in the Blanks'],
            'kind' => Setting::$activity_kinds[1],
            'type' => Setting::$activity_types[3],
            'return_value' => ['param1' => 'Yenilikçilik']
        ]);
        $activity->save();

        //////////////////////////////////////////////////////////
        // do action
        $activity = new Activity([
            'name' => ['tr' => 'Slaytları İzle', 'en' => 'ُPLay Slide Shows'],
            'type' => Setting::$activity_types[0],
            'kind' => Setting::$activity_kinds[0],
        ]);
        $activity->save();
        for ($i = 0; $i < 5; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order'=>$i,
                'image' => Intervention::make(resource_path("images/activity/team_work/{$i}.jpg")),
            ]));
        }
        // return value
        $activity = new Activity([
            'name' => ['tr' => 'Kelimeyi Gir', 'en' => 'Fill in the Blanks'],
            'kind' => Setting::$activity_kinds[1],
            'type' => Setting::$activity_types[3],
            'return_value' => ['param1' => 'Ekip Çalışması']
        ]);
        $activity->save();

        ///////////////////////////////////////////////////////
        //Category Eğitim Adası
        ///////////////////////////////////////////////////////
        ///// do action
        $activity = new Activity([
            'name' => ['tr' => 'Slaytları İzle', 'en' => 'ُPLay Slide Shows'],
            'type' => Setting::$activity_types[0],
            'kind' => Setting::$activity_kinds[0],
        ]);
        $activity->save();
        for ($i = 0; $i < 5; $i++) {
            $activity->image()->save(new  \App\Models\Image([
                'order'=>$i,
                'image' => Intervention::make(resource_path("images/activity/covid19/{$i}.jpg")),
            ]));
        }

    }
}
