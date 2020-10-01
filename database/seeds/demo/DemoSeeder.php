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
        $this->call(ActivityResultTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        //$this->call(ProfileTableSeeder::class);
        $this->call(UserPointTableSeeder::class);

        /*if (app()->environment('local')) {
            $this->call(FakeSeeder::class);
        }*/
    }
}
