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
        $this->call(CampusTableSeeder::class);
        $this->call(SchoolTableSeeder::class);
        $this->call(ClassroomsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(TaskTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ClubTableSeeder::class);
        $this->call(PointTableSeeder::class);
        /*if (app()->environment('local')) {
            $this->call(FakeSeeder::class);
        }*/
    }
}
