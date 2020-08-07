<?php
namespace App\Database\Seeds\Demo;
use App\Models\Classroom;
use App\Models\Introduction;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $domain_name=Setting::getByKey(Setting::DOMAIN_NAME);
        //Get the role of admin
        //$role = app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()::findByName('admin');true
        $role_student = \App\Models\Role::findByName(\App\Models\Setting::ROLE_STUDENT, 'web');
        $role_teacher = \App\Models\Role::findByName(\App\Models\Setting::ROLE_TEACHER, 'web');

        $classroom1 = Classroom::find(1);
        $classroom2= Classroom::find(2);
        $classroom3 = Classroom::find(3);

        ///////////    ///////////           ///////////           ///////////           ///////////
        /// ///////////           ///////////           ///////////           ///////////           ///////////
        $teacher = factory(\App\Models\User::class)->make([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğretmen@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Javad Fathi',
        ]);
        $teacher->save();
        $teacher->assignRole($role_teacher);
        $teacher->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/teacher.png")),
        ]));
        ///////////////////////////////////////////////////////
        $teacher = factory(\App\Models\User::class)->create([
            'username' =>  rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğretmen1@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Enver Türkmen',

        ]);
        $teacher->assignRole($role_teacher);
        $teacher->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/teacher.png")),
        ]));
        ///////////    ///////////           ///////////           ///////////           ///////////
        /// ///////////           ///////////           ///////////           ///////////           ///////////

        $student0 = factory(\App\Models\User::class)->create([
            'username' =>  rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci0@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hasan Rıza Uzuner',

        ]);
        event(new \App\Events\UserCreated($student0));

        $student0->assignRole($role_student);
        $student0->classroom()->sync($classroom1);
        $student0->setArtifactStatus( Setting::ARTIFACT_CLUB, 0);
        $student0->setArtifactStatus( Setting::ARTIFACT_PROJECT, 0);
        $student0->setArtifactStatus( Setting::ARTIFACT_TASK, 0);
        $student0->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 0);
        $student0->setArtifactStatus( Setting::ARTIFACT_GENERAL, 0);

        $student0->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male.png")),
        ]));
        unset($student0);
        ////////////////////////////////////////////
        $student1 = factory(\App\Models\User::class)->create([
            'username' =>55555555555,
            'gender' => 1,
            'email' => 'öğrenci1@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Talha Boyraz',

        ]);
        event(new \App\Events\UserCreated($student1));

        $student1->assignRole($role_student);
        $student1->classroom()->sync($classroom1);

        $student1->setArtifactStatus( Setting::ARTIFACT_CLUB, 1);
        $student1->setArtifactStatus( Setting::ARTIFACT_PROJECT, 1);
        $student1->setArtifactStatus( Setting::ARTIFACT_TASK, 1);
        $student1->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 1);
        $student1->setArtifactStatus( Setting::ARTIFACT_GENERAL, 1);

        $student1->setCurrentXp( Setting::ARTIFACT_PROJECT, 1, 140);
        $student1->setCurrentXp( Setting::ARTIFACT_CLUB, 1, 120);
        $student1->setCurrentXp( Setting::ARTIFACT_TASK, 1, 80);
        $student1->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 1, 50);
        $student1->setCurrentXp( Setting::ARTIFACT_GENERAL, 1, 700);

        $student1->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $student1->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
        ]));
        unset($student1);
        ////////////////////////////////////////////
        $student2 = factory(\App\Models\User::class)->create([
            'username' =>66666666666,
            'gender' => 1,
            'email' => 'öğrenci2@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Arın Şüküroğlu',
        ]);
        event(new \App\Events\UserCreated($student2));

        $student2->assignRole($role_student);
        $student2->classroom()->sync($classroom2);

        $student2->setArtifactStatus( Setting::ARTIFACT_CLUB, 2);
        $student2->setArtifactStatus( Setting::ARTIFACT_PROJECT, 2);
        $student2->setArtifactStatus( Setting::ARTIFACT_TASK, 2);
        $student2->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 2);
        $student2->setArtifactStatus( Setting::ARTIFACT_GENERAL, 2);

        $student2->setCurrentXp( Setting::ARTIFACT_PROJECT, 2, 150);
        $student2->setCurrentXp( Setting::ARTIFACT_CLUB, 2, 120);
        $student2->setCurrentXp( Setting::ARTIFACT_TASK, 2, 110);
        $student2->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 2, 90);
        $student2->setCurrentXp( Setting::ARTIFACT_GENERAL, 2, 800);

        $student2->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $student2->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male4.png")),
        ]));
        unset($student2);
        ////////////////////////////////////////////
        $student3 = factory(\App\Models\User::class)->create([
            'username' =>77777777777,
            'gender' => 0,
            'email' => 'öğrenci3@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ebru Akbulut',

        ]);
        event(new \App\Events\UserCreated($student3));

        $student3->assignRole($role_student);
        $student3->classroom()->sync($classroom2);

        $student3->setArtifactStatus( Setting::ARTIFACT_CLUB, 3);
        $student3->setArtifactStatus( Setting::ARTIFACT_PROJECT, 3);
        $student3->setArtifactStatus( Setting::ARTIFACT_TASK, 3);
        $student3->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 3);
        $student3->setArtifactStatus( Setting::ARTIFACT_GENERAL, 3);

        $student3->setCurrentXp( Setting::ARTIFACT_PROJECT, 3, 120);
        $student3->setCurrentXp( Setting::ARTIFACT_CLUB, 3, 150);
        $student3->setCurrentXp( Setting::ARTIFACT_TASK, 3, 80);
        $student3->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 3, 50);
        $student3->setCurrentXp( Setting::ARTIFACT_GENERAL, 3, 1000);

        $student3->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $student3->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/female/female5.png")),
        ]));
        unset($student3);
        ////////////////////////////////////////////
        $student4 = factory(\App\Models\User::class)->create([
            'username' =>88888888888,
            'gender' => 1,
            'email' => 'öğrenci4@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Can Yücel',

        ]);
        event(new \App\Events\UserCreated($student4));

        $student4->assignRole($role_student);
        $student4->classroom()->sync($classroom3);

        $student4->setArtifactStatus( Setting::ARTIFACT_CLUB, 4);
        $student4->setArtifactStatus( Setting::ARTIFACT_PROJECT, 4);
        $student4->setArtifactStatus( Setting::ARTIFACT_TASK, 4);
        $student4->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 4);
        $student4->setArtifactStatus( Setting::ARTIFACT_GENERAL, 4);

        $student4->setCurrentXp( Setting::ARTIFACT_PROJECT, 4, 190);
        $student4->setCurrentXp( Setting::ARTIFACT_CLUB, 4, 160);
        $student4->setCurrentXp( Setting::ARTIFACT_TASK, 4, 70);
        $student4->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 4, 40);
        $student4->setCurrentXp( Setting::ARTIFACT_GENERAL, 4, 1100);

        $student4->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $student4->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male12.png")),
        ]));
        unset($student4);
        ////////////////////////////////////////////
        $student5 = factory(\App\Models\User::class)->create([
            'username' =>99999999999,
            'gender' => 1,
            'email' => 'öğrenci5@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aras Şüküroğlu',

        ]);
        event(new \App\Events\UserCreated($student5));

        $student5->assignRole($role_student);
        $student5->classroom()->sync($classroom3);

        $student5->setArtifactStatus( Setting::ARTIFACT_CLUB, 5);
        $student5->setArtifactStatus( Setting::ARTIFACT_PROJECT, 5);
        $student5->setArtifactStatus( Setting::ARTIFACT_TASK, 5);
        $student5->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 5);
        $student5->setArtifactStatus( Setting::ARTIFACT_GENERAL, 5);

        $student5->setCurrentXp( Setting::ARTIFACT_PROJECT, 5, 505);
        $student5->setCurrentXp( Setting::ARTIFACT_CLUB, 5, 370);
        $student5->setCurrentXp( Setting::ARTIFACT_TASK, 5, 260);
        $student5->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 5, 140);
        $student5->setCurrentXp( Setting::ARTIFACT_GENERAL, 5, 1200);

        $student5->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $student5->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male7.png")),
        ]));
        unset($student5);
        ///////////           ///////////           ///////////           ///////////           ///////////
                  ///////////           ///////////           ///////////           ///////////
        $students = [];

        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci60@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Murat Akçay',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci61@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Karslı',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci62@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Tolga Işık',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci63@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sevilay Ataman',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci64@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bora Atay',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'göksel@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Göksel Kesim',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci65@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Acun Akyol',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'ercan@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ercan Altuğ Yılmaz',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'aras@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aras Şüküroğlu',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'ismail@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İsmail Çendik',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'esra@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Esra Sözen',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'elif@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Elif Baş',
        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'merve@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Öztürk',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'ayşe@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ayşe Yılmaz',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'nazlı@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nazlı Uçar',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'üstün@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Üstün',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'mesut@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Mesut Güneri',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'hüsnü@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hüsnü Çoban',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'sena@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sena Yılmaz',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'selenay@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Selenay Özaltın',
        ]);
        $students[] = $student;

        // Classroom1
        foreach ($students as $student) {
            event(new \App\Events\UserCreated($student));

            $student->assignRole($role_student);
            $student->classroom()->sync($classroom1);
            $intro = rand(0, 1);
            $index = $student->gender == 0 ? rand(1,28): rand(1,22);
            $gender = $student->gender == 0 ? 'female': 'male';
            if($intro == 1) {
                $student->setArtifactStatus( Setting::ARTIFACT_CLUB, 1);
                $student->setArtifactStatus( Setting::ARTIFACT_PROJECT, 1);
                $student->setArtifactStatus( Setting::ARTIFACT_TASK, 1);
                $student->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 1);
                $student->setArtifactStatus( Setting::ARTIFACT_GENERAL, 1);

                $student->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

                $student->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
                ]));
            }
        else {
                $student->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}.png")),
                ]));
            }
        }
        unset($intro);
        unset($students);

        $students = [];

        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci6@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Fevzi Çalışkan',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci7@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Hamdi Akyol',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci8@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Selim Yıldız',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci9@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ebru Akbulut',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci10@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kerim İnan',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci11@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Okan Küçük',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci12@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yılmaz Şen',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci13@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kaan Lokumcu',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci14@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Berke Öztürk',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci15@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Çağatay Ekinci',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci16@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sarp Kaya',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci17@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Düşkuran',
        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci18@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Şengül Artıran',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci19@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Lamia Altın',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci20@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nazlı Uçmaz',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci21@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Pelin Demirbilek',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci22@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yasemin İnce',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci23@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Handan',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci24@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sena Karaman',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci25@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İrem Sancar',

        ]);
        $students[] = $student;
        // Classroom2
        foreach ($students as $student) {
            event(new \App\Events\UserCreated($student));

            $gender = $student->gender == 0 ? 'female': 'male';
            $index = $student->gender == 0 ? rand(1,28): rand(1,22);

            $student->assignRole($role_student);
            $student->classroom()->sync($classroom2);

            $student->setArtifactStatus( Setting::ARTIFACT_CLUB,rand(1, 2));
            $student->setArtifactStatus( Setting::ARTIFACT_PROJECT,rand(1, 2));
            $student->setArtifactStatus( Setting::ARTIFACT_TASK,rand(1, 2));
            $student->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER,rand(1, 2));
            $student->setArtifactStatus( Setting::ARTIFACT_GENERAL,rand(1, 2));

            $student->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

            $student->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
            ]));
        }

        unset($students);

        $students = [];

        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci26@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Metin Alpaslan',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci27@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Berk Özcan',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci28@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Garp Can Elmas',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci29@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İsa Emre Gül',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci30@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Abdullah Kuşaslan',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci31@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kerem Onur Bekçi',

        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci32@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Enes Öncel',
        ]);
        $students[] = $student;

        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci33@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hakan Şener',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci34@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Emrecan Küçüksarı',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci35@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Yasin Yılmaz',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'öğrenci36@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yusuf Akyol',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci37@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gamze Aksu',
        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci38@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Okuyucu',

        ]);
        $students[] = $student;
        ///////////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci39@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İrem Eyüboğlu',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci40@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Erdem',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci41@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yaren Doğan',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci42@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ceren Yalçın',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci43@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hazal Yılmaz',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci44@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aysu Göregen',

        ]);
        $students[] = $student;
        /////
        $student = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'öğrenci45@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Pınar Yarasaran',

        ]);
        $students[] = $student;
        // Classroom3
        foreach ($students as $student) {
            event(new \App\Events\UserCreated($student));

            $gender = $student->gender == 0 ? 'female': 'male';
            $index = $student->gender == 0 ? rand(1,28): rand(1,22);
            $student->assignRole($role_student);
            $student->classroom()->sync($classroom3);

            $student->setArtifactStatus( Setting::ARTIFACT_CLUB, rand(2, 5));
            $student->setArtifactStatus( Setting::ARTIFACT_PROJECT, rand(2, 5));
            $student->setArtifactStatus( Setting::ARTIFACT_TASK, rand(2, 5));
            $student->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, rand(2, 5));
            $student->setArtifactStatus( Setting::ARTIFACT_GENERAL, rand(2, 5));

            $student->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

            $student->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
            ]));
        }
    }
}
