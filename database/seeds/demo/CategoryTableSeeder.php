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
        app()->setLocale('tr');
        //$category_names=['Temel Yetkinlikler','Yönetsel Yetkinlikler','Üst Düzey Yetkinlikler','Değler','Eğlence',];
        $category_names=['Yetkinlikler','Değeler','Eğlence'];

        foreach($category_names as $category_name){
            $category = new \App\Models\Category([
                'name:'.app()->getLocale() => stripLowercaseName($category_name),
            ]);
            $category->save();
            $category->users()->attach([1,2,3]);
        }
    }
}
