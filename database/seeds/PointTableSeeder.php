<?php

use Illuminate\Database\Seeder;

class PointTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Point::create([
            'user_id'=> 5,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 30
        ]);

        \App\Models\Point::create([
            'user_id'=> 5,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 30
        ]);
        \App\Models\Point::create([
            'user_id'=> 5,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_QUESTION_ANSWER,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>6,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 25
        ]);
        \App\Models\Point::create([
            'user_id'=>6,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 25
        ]);
        \App\Models\Point::create([
            'user_id'=>7,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 50
        ]);
        \App\Models\Point::create([
            'user_id'=>7,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>8,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>3,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 50
        ]);
        \App\Models\Point::create([
            'user_id'=>3,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_QUESTION_ANSWER,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>9,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_QUESTION_ANSWER,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>9,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 20
        ]);
        \App\Models\Point::create([
            'user_id'=>10,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_GENERAL,
            'point' => 40
        ]);
        \App\Models\Point::create([
            'user_id'=>10,
            'artifact_name'=> \App\Models\Setting::ARTIFACT_QUESTION_ANSWER,
            'point' => 25
        ]);

    }
}
