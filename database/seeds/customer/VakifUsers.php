<?php

namespace App\Database\Seeds\Customer;

use Illuminate\Database\Seeder;

class VakifUsers extends Seeder
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
        //Burak Sezer: burak.sezer@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'mahmutserdar.yuksel@vakifkatilim.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Mahmut Serdar',
            'surname' => 'Yuksel',
        ]);
        //Uğur Bilgin: ugur.bilgin@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 1,
            'email' => 'necati.mentese@vakifkatilim.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Necati',
            'surname' => 'Menteşe',
        ]);

        foreach ($users as $key => $user) {

            $user->save();
            $user->assignRole($role_user);

            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/male/{$key}.png")),
            ]));
            //Add workflow to users
            /*$workflows = \App\Models\CustomWorkflow::pluck('id');
            $user->workflows()->attach($workflows, ['marking' => '"the_blanks"']);

            UserPoint::create([
                'user_id' => $user->id,
                'category_id' => 1,
                'point' => 15
            ]);
            UserPoint::create([
                'user_id' => $user->id,
                'category_id' => 2,
                'point' => 15
            ]);*/

        }
        unset($users);


        ///////////////////////Females
        //Banu Tosun: banu.tosun@bilkom.com.tr
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000, 99999999999),
            'gender' => 0,
            'email' => 'banu.kaya@vakifkatilim.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Banu',
            'surname' => 'Kaya',
        ]);

        foreach ($users as $key => $user) {

            $user->save();
            $user->assignRole($role_user);

            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/female/{$key}.png")),
            ]));
            //Add workflow to users
            /*$workflows = \App\Models\CustomWorkflow::pluck('id');

            $user->workflows()->attach($workflows, ['marking' => '"the_blanks"']);

            UserPoint::create([
                'user_id' => $user->id,
                'category_id' => 1,
                'point' => 15
            ]);
            UserPoint::create([
                'user_id' => $user->id,
                'category_id' => 2,
                'point' => 15
            ]);*/

        }
    }
}

