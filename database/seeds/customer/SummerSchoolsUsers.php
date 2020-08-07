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
        $role_student = \App\Models\Role::findByName(\App\Models\Setting::ROLE_STUDENT, 'web');

        //$classroom1 = Classroom::find(1);
        //$classroom2 = Classroom::find(2);
        $classroom3 = Classroom::find(3);

        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'burakkara0634@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Burak Kara',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'nesibekara34@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nesibe Kara',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'nesrincoban@bilfen.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nesrin Çoban',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'esrakaya3135@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Esra Kaya',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'xartos74@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Murat Aytaç',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'zeynepardam@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Zeynep Aydın',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'emeltorer@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Emel Torer',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'wervegur@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Gür',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gulbin.guney@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gülbin Güney',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'ysmcylnn@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yeşim Ceylan',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'arzukupsar@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Arzu Kupsar',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'calpbuket@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Buket Calp Cansız',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'bsee.yildirim@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Buse Yıldırım',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'mslmoglu1806@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Müge İçöz',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gulsencengiz@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gülşen Yıldırım',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'tolgamutludag@pembelimon.com.tr',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Tolga Mutludağ',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'tasciogluseher@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Seher Taşçioğlu Tavlı',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'bahar_kazik@hotmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Güner',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'gorkemtilic@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Görkem Tılıç',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'mihribanbt@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Mihriban Türkmen',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'ufuk.tutal@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ufuk Tutal',
        ]);
        $students[] = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 0,
            'email' => 'yelizdemir01@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yeliz Demir',
        ]);

        foreach ($students as $student) {

            $student->save();
            event(new \App\Events\UserCreated($student));

            $student->assignRole($role_student);
            $student->classroom()->sync($classroom3);


            $student->setArtifactStatus(Setting::ARTIFACT_CLUB, 1);
            $student->setArtifactStatus(Setting::ARTIFACT_PROJECT, 1);
            $student->setArtifactStatus(Setting::ARTIFACT_TASK, 1);
            $student->setArtifactStatus(Setting::ARTIFACT_QUESTION_ANSWER, 1);
            $student->setArtifactStatus(Setting::ARTIFACT_GENERAL, 1);

            $student->setCurrentXp(Setting::ARTIFACT_PROJECT, 1, 140);
            $student->setCurrentXp(Setting::ARTIFACT_CLUB, 1, 120);
            $student->setCurrentXp(Setting::ARTIFACT_TASK, 1, 80);
            $student->setCurrentXp(Setting::ARTIFACT_QUESTION_ANSWER, 1, 50);
            $student->setCurrentXp(Setting::ARTIFACT_GENERAL, 1, 700);

            $student->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

            if ($student->gender == 1) {
                $student->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
                ]));
            } else {
                $student->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/female/female1.png")),
                ]));
            }

        }
    }
}

