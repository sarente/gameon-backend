<?php
namespace App\Database\Seeds\Demo;
use App\Models\Classroom;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Classroom::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $class = Classroom::create([
            'school_id' => 2,
            'number' => 6,
            'branch' => 'A',
        ]);
        Classroom::create([
            'school_id' => 5,
            'number' => 7,
            'branch' => 'A',
        ]);
        Classroom::create([
            'school_id' => 2,
            'number' => 7,
            'branch' => 'B',
        ]);
        Classroom::create([
            'school_id' => 5,
            'number' => 7,
            'branch' => 'C',
        ]);
        Classroom::create([
            'school_id' => 2,
            'number' => 6,
            'branch' => 'B',
        ]);
        Classroom::create([
            'school_id' => 5,
            'number' => 6,
            'branch' => 'C',
        ]);
    }
}
