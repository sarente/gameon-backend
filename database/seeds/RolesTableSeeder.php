<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $role_admin = \Spatie\Permission\Models\Role::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::ROLE_ADMIN
        ]);

        $role_admin->syncPermissions([
            \App\Models\Setting::PERMISSION_QUESTION_CREATE,
            \App\Models\Setting::PERMISSION_ROSETTE_CREATE,
            \App\Models\Setting::PERMISSION_ROSETTE_DELETE,
            \App\Models\Setting::PERMISSION_ROSETTE_UPDATE
        ]);

        $role_user = \Spatie\Permission\Models\Role::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::ROLE_USER
        ]);

        $role_supervisor = \Spatie\Permission\Models\Role::create([
            'guard_name' => config('auth.defaults.guard'),
            'name' => \App\Models\Setting::ROLE_SUPERVISOR
        ]);

        $role_supervisor->syncPermissions([
            \App\Models\Setting::PERMISSION_QUESTION_CREATE,
            \App\Models\Setting::PERMISSION_ROSETTE_CREATE,
            \App\Models\Setting::PERMISSION_ROSETTE_DELETE,
            \App\Models\Setting::PERMISSION_ROSETTE_UPDATE
        ]);
    }
}
