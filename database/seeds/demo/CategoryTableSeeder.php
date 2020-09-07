<?php

namespace App\Database\Seeds\Demo;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category([
            'name' => "Test Category"
        ]);
        $category->save();
        $category->users()->attach([1,2,3]);
    }
}
