<?php

namespace App\Database\Seeds\Customer;

use App\Models\Classroom;
use App\Models\Introduction;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class   SummerSchoolsUsers extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //Get the role of admin
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, 'web');

        //$classroom1 = Classroom::find(1);
        //$classroom2 = Classroom::find(2);
        $classroom3 = Classroom::find(3);

        //Burak Sezer: burak.sezer@bilkom.com.tr
        //Banu Tosun: banu.tosun@bilkom.com.tr
        //Uğur Bilgin: ugur.bilgin@bilkom.com.tr
        //Hazal Sayın: hazal.sayin@bilkom.com.tr
        //Çağla Gürel: cagla.gurel@bilkom.com.tr
        //Çağrı Vançin: cagri.vancin@bilkom.com.tr
        //

        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'burakkara0634@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Burak Kara',
        ]);

        foreach ($users as $user) {

            $user->save();
            event(new \App\Events\UserCreated($user));

            $user->assignRole($role_user);
            $user->classroom()->sync($classroom3);

            //$user->setArtifactStatus(Setting::ARTIFACT_CLUB, 1);

            if ($user->gender == 1) {
                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
                ]));
            } else {
                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/female/female1.png")),
                ]));
            }

        }
    }
}

