<?php

namespace App\Database\Seeds\Customer;

use App\Models\Classroom;
use App\Models\Introduction;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SummerSchoolsUsers extends Seeder
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

        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'burakkara0634@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Burak Kara',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'nesibekara34@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nesibe Kara',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'nesrincoban@bilfen.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nesrin Çoban',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'esrakaya3135@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Esra Kaya',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'xartos74@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Murat Aytaç',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'zeynepardam@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Zeynep Aydın',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'emeltorer@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Emel Torer',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'wervegur@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Gür',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gulbin.guney@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gülbin Güney',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'ysmcylnn@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yeşim Ceylan',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'arzukupsar@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Arzu Kupsar',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'calpbuket@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Buket Calp Cansız',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'bsee.yildirim@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Buse Yıldırım',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'mslmoglu1806@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Müge İçöz',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gulsencengiz@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gülşen Yıldırım',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'tolgamutludag@pembelimon.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Tolga Mutludağ',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'tasciogluseher@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Seher Taşçioğlu Tavlı',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'bahar_kazik@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Güner',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gorkemtilic@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Görkem Tılıç',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'mihribanbt@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Mihriban Türkmen',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'ufuk.tutal@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ufuk Tutal',
        ]);
        $users[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'yelizdemir01@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yeliz Demir',
        ]);

        foreach ($users as $user) {

            $user->save();
            event(new \App\Events\UserCreated($user));

            $user->assignRole($role_user);
            $user->classroom()->sync($classroom3);


            $user->setArtifactStatus(Setting::ARTIFACT_CLUB, 1);
            $user->setArtifactStatus(Setting::ARTIFACT_PROJECT, 1);
            $user->setArtifactStatus(Setting::ARTIFACT_TASK, 1);
            $user->setArtifactStatus(Setting::ARTIFACT_QUESTION_ANSWER, 1);
            $user->setArtifactStatus(Setting::ARTIFACT_GENERAL, 1);

            $user->setCurrentXp(Setting::ARTIFACT_PROJECT, 1, 140);
            $user->setCurrentXp(Setting::ARTIFACT_CLUB, 1, 120);
            $user->setCurrentXp(Setting::ARTIFACT_TASK, 1, 80);
            $user->setCurrentXp(Setting::ARTIFACT_QUESTION_ANSWER, 1, 50);
            $user->setCurrentXp(Setting::ARTIFACT_GENERAL, 1, 700);

            $user->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

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

