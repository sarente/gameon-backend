<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Status::create([
            'name' => "Started",
        ]);

        \App\Models\Status::create([
            'name' => "Pending",
        ]);

        \App\Models\Status::create([
            'name' => "Done",
        ]);
    }
}
