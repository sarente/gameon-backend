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
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Models\User::orderBy('id')->delete();
        $domain_name= "test.com";


        //Get the role of admin
        //$role = app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()::findByName('admin');

        $role_admin = \App\Models\Role::findByName(\App\Models\Setting::ROLE_ADMIN, config('auth.defaults.guard'));
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, config('auth.defaults.guard'));
        $role_supervisor = \App\Models\Role::findByName(\App\Models\Setting::ROLE_SUPERVISOR, config('auth.defaults.guard'));

        ///////////
        $name=app()->environment('production')?'Administrator':'Test Admin';
        $admin = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'admin@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('g@meon'),
            'name' => $name,
            'surname' => $name,

        ]);
        $admin->assignRole($role_admin);

        ///////////
        $name=app()->environment('production')?'User':'Test User';
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,
            'surname' => $name,

        ]);

        $user->assignRole($role_user);

        ///////////
        $name=app()->environment('production')?'Advisor':'Test Advisor';
        $supervisor = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'advisor@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => $name,
            'surname' => $name,

        ]);

        $supervisor->assignRole($role_supervisor);
    }
}
