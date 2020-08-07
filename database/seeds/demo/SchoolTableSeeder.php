<?php
namespace App\Database\Seeds\Demo;
use Illuminate\Database\Seeder;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        \App\Models\School::create([
            'name' => 'İlk okul',
            'campus_id' => 1
        ]);

        \App\Models\School::create([
            'name' => 'Orta okul',
            'campus_id' => 1
        ]);

        \App\Models\School::create([
            'name' => 'Lise',
            'campus_id' => 2
        ]);
        \App\Models\School::create([
            'name' => 'İlk okul',
            'campus_id' => 2
        ]);

        \App\Models\School::create([
            'name' => 'Orta okul',
            'campus_id' => 2
        ]);
        \App\Models\School::create([
            'name' => 'Lise',
            'campus_id' => 2
        ]);
    }
}
