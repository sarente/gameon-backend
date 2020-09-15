<?php

namespace App\Database\Seeds\Demo;

use App\Models\Category;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    //FIXME: get it from setting
    private $max_level_count = 5;

    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Level::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::pluck('id')->toArray();

        Category::get()->each(function ($cat) {
            for ($i = 0; $i < $this->max_level_count; $i++)
                Level::create([
                    'level_no' => $i,
                    'max_point' => $i > 0 ? 200 : 0,
                    'category_id' => $cat->id,
                ]);
        });
    }
}
