<?php

namespace App\Database\Seeds\Customer;

use Illuminate\Database\Seeder;

class Bilkom2Users extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //Get the role of admin
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, config('auth.defaults.guard'));

        //Males

        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'hakan.yildiz@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hakan',
            'surname' => 'Yildiz',
        ]);
        //
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'ozan.alisar@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ozan',
            'surname' => 'Alişar',
        ]);
        //
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'gokhan.ozdemir@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gökhan',
            'surname' => 'Özdemir',
        ]);
        //
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'tayfun.toygar@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Tayfun',
            'surname' => 'Toygar',
        ]);
        //Çağrı Vançin: cagri.vancin@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'inan.arslan@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İnan',
            'surname' => 'Arslan',
        ]);

        foreach ($users as $key => $user) {
            if ($key > 1) $key %= 2;
            $user->save();
            $user->assignRole($role_user);
            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/male/{$key}.png")),
            ]));
        }
        unset($users);

        ///////////////////////Females
        //
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 0,
            'email' => 'seda.ozeren@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Seda',
            'surname' => 'Özeren',
        ]);
        foreach ($users as $key => $user) {
            $user->save();
            $user->assignRole($role_user);
            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/female/{$key}.png")),
            ]));
        }
    }
}