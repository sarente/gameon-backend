<?php

use Illuminate\Database\Seeder;

class PostureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Avatar\Posture::create([
            'posture'=> 0,
        ]);

        \App\Models\Avatar\Posture::create([
            'posture'=> 1,
        ]);
    }
}
