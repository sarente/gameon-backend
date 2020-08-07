<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_PROJECT_CREATE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_ATTACH
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_DETACH
        ]);


        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_HOLD
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_CREATE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_DELETE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_ROSETTE_UPDATE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_CLUB_CREATE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_QUESTION_CREATE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_QUESTION_DELETE
        ]);

        \App\Models\Permission::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::PERMISSION_TASK_CREATE
        ]);
    }
}
