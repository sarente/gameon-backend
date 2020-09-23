<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //This seeder used in user creation

        //$this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RewardSeeder::class);
    }
}
