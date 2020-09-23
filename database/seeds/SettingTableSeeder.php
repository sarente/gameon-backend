<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Setting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Models\Setting::create([
            'key' => Setting::DOMAIN_NAME,
            'value' => app()->environment('production') ? Setting::DOMAIN_REAL : Setting::DOMAIN_TEST,
        ]);

        \App\Models\Setting::create([
            'key' => Setting::LAST_LEVEL,
            'value' => env('LAST_LEVEL', 5),
        ]);

        \App\Models\Setting::create([
            'key' => Setting::URL_STUDENT_INTRO,
            'value' => Config::get('urls.user_intro_url'),
            //'value'    => env('STUDENT_INTRO_URL'),
        ]);

        \App\Models\Setting::create([
            'key' => Setting::URL_STUDENT,
            'value' => Config::get('urls.user_url'),
            //'value'    => env('STUDENT_URL'),
        ]);

        \App\Models\Setting::create([
            'key' => Setting::URL_TEACHER,
            'value' => Config::get('urls.Role_url'),
            //'value'    => env('TEACHER_URL'),
        ]);

        \App\Models\Setting::create([
            'key' => Setting::URL_ADMIN,
            'value' => Config::get('urls.admin_url'),
            //'value'    => env('ADMIN_URL'),
        ]);

        \App\Models\Setting::create([
            'key' => Setting::LEVEL_COUNT,
            'value' => 5,
        ]);

        \App\Models\Setting::create([
            'key' => Setting::EDUCATION_TERM,
            'value' => 8,
        ]);
        \App\Models\Setting::create([
            'key' => Setting::ARTIFACT_MONTHLY,
            'value' => 3,
        ]);

    }
}
