<?php
namespace App\Database\Seeds\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Customer demo users
        //$this->call(VakifUsers::class);
        $this->call(Bilkom2Users::class);
        //$this->call(BilkomUsers::class);
    }
}
