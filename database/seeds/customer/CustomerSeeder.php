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

        $this->call(SummerSchoolsUsers::class);
        $this->call(UserIelevSeeder::class);
        $this->call(UserMedicanaSeeder::class);
        $this->call(UserIstekSeeder::class);
        $this->call(UserSevincSeeder::class);
        $this->call(UserKaynakSeeder::class);
        $this->call(UserMatpiSeeder::class);
        $this->call(UserAtlasSeeder::class);
        $this->call(UserBilfenSeeder::class);
        $this->call(UserSaintJosephSeeder::class);

        //Yaz okullari--Summer schools


        /*if (app()->environment('local')) {
            $this->call(FakeSeeder::class);
        }*/
    }
}
