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
                'name:'.app()->getLocale() => $category_names,
            ]);
            $category->save();
            $category->users()->attach([1,2,3]);
        }
    }
    private function convertToName($zname_clean){
        // strip out all whitespace
        $zname_clean = preg_replace('/\s*/', '', $zname_clean);
        // convert the string to all lowercase
        return strtolower($zname_clean);
    }
}
