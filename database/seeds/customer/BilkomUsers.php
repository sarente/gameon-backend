<?php

namespace App\Database\Seeds\Customer;

use Illuminate\Database\Seeder;

class BilkomUsers extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //Get the role of admin
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, config('auth.defaults.guard'));

        //Burak Sezer: burak.sezer@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'burak.sezer@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Burak',
            'surname' => 'Sezer',
        ]);
        //Banu Tosun: banu.tosun@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'banu.tosun@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Banu',
            'surname' => 'Tosun',
        ]);
        //Uğur Bilgin: ugur.bilgin@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'ugur.bilgin@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Uğur',
            'surname' => 'Bilgin',
        ]);
        //Hazal Sayın: hazal.sayin@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'hazal.sayin@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hazal',
            'surname' => 'Sayın',
        ]);
        //Çağla Gürel: cagla.gurel@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'cagla.gurel@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Çağla',
            'surname' => 'Gürel',
        ]);
        //Çağrı Vançin: cagri.vancin@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'cagri.vancin@bilkom.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Çağrı',
            'surname' => 'Vançin',
        ]);

        foreach ($users as $user) {

            $user->save();
            $user->assignRole($role_user);

            if ($user->gender == 1) {
                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
                ]));
            } else {
                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/female/female1.png")),
                ]));
            }
            //Add workflow to users
            $workflows = \App\Models\CustomWorkflow::pluck('id');
            $user->workflows()->attach($workflows, ['marking' => '"the_blanks"']);

        }
    }
}

