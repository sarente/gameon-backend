<?php
namespace App\Database\Seeds\Demo;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Campus::create([
            'name' => 'Sarente',
        ]);
        \App\Models\Campus::create([
            'name' => 'İTÜ',
        ]);
    }
}
