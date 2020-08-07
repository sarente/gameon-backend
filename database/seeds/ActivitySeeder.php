<?php

use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Activity::create([
            'name' => "Proje 1",
            'category_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\Activity::create([
            'name' => "Proje 2",
            'category_id' => 1,
            'user_id' => 1,
        ]);

        \App\Models\Activity::create([
            'name' => "Görev 1",
            'category_id' => 2,
            'user_id' => 1,
        ]);

        \App\Models\Activity::create([
            'name' => "Görev 1",
            'category_id' => 2,
            'user_id' => 1,
        ]);
    }
}
