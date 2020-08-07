<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category([
            //'name:tr' => "Projeler"
        ]);
        $category->save();
        $category->statuses()->attach([1, 2]);

        $category = new \App\Models\Category([
            //'name:tr' => "Görevler"
        ]);
        $category->save();
        $category->statuses()->attach([2, 3, 4]);
    }
}
