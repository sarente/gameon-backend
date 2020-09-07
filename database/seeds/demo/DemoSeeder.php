<?php
namespace App\Database\Seeds\Demo;
use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ActivityTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(PointTableSeeder::class);

        /*if (app()->environment('local')) {
            $this->call(FakeSeeder::class);
        }*/
    }
}
