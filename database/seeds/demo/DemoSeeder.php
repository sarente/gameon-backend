<?php
namespace App\Database\Seeds\Demo;
use App\Models\Result;
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
        $this->call(CategoryTableSeeder::class);
        $this->call(WorkflowTableSeeder::class);
        $this->call(ActivityTableSeeder::class);
        $this->call(ResultTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        //$this->call(RewardSeeder::class);
        //$this->call(ProfileTableSeeder::class);
        //$this->call(UserPointTableSeeder::class);

        /*if (app()->environment('local')) {
            $this->call(FakeSeeder::class);
        }*/
    }
}
