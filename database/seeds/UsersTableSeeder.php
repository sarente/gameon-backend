<?php

use App\Models\Classroom;
use App\Models\Introduction;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Models\User::orderBy('id')->delete();
        $domain_name= "test.com";


        //Get the role of admin
        $name=app()->environment('production')?'Administrator':'Test Admin';
        ///////////
        $admin = factory(\App\Models\User::class)->create([
            'username' => 11111111111,
            'gender' => 0,
            'email' => 'admin@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('g@meon'),
            'name' => $name,

        ]);

        ///////////
        $name=app()->environment('production')?'Student':'Test Student';
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'student@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,

        ]);


        ///////////
        $name=app()->environment('production')?'Teacher':'Test Teacher';
        $teacher = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'teacher@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,

        ]);

    }
}
