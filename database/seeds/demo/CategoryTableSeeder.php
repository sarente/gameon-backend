<?php

namespace App\Database\Seeds\Demo;

use App\Models\User;
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
        //First of all add permission to db then create roles thus connect the permission to related role
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Category::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users=User::pluck('id')->toArray();

        //$category_names=[['tr'=>'Değeler','en'=>'Values'],['tr'=>'Yetkinlikler','en'=>'Competence'],['tr'=>'Eğlence','en'=>'Entertainment']];
        $category_names=[['tr'=>'Değeler','en'=>'Values'],['tr'=>'Yetkinlikler','en'=>'Competence']];

        foreach($category_names as $category_name){
            $category = new \App\Models\Category([
                'name'=> $category_name,
            ]);
            $category->save();
        }
    }
}
