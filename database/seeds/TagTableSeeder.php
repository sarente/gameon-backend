<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tag::create([
            'label' => 'robotik',
        ]);

        \App\Models\Tag::create([
            'label' => 'kodlama',
        ]);

        \App\Models\Tag::create([
            'label' => 'matematik',
        ]);

        \App\Models\Tag::create([
            'label' => 'bilim',
        ]);

        \App\Models\Tag::create([
            'label' => 'doğa',
        ]);
    }
}
