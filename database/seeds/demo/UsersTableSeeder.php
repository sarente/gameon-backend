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
        $role_user = \App\Models\Role::findByName(\App\Models\Setting::ROLE_USER, 'web');
        $role_supervisor = \App\Models\Role::findByName(\App\Models\Setting::ROLE_SUPERVISOR, 'web');

        $classroom1 = Classroom::find(1);
        $classroom2= Classroom::find(2);
        $classroom3 = Classroom::find(3);

        ///////////    ///////////           ///////////           ///////////           ///////////
        /// ///////////           ///////////           ///////////           ///////////           ///////////
        $supervisor = factory(\App\Models\User::class)->make([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'supervisor@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Javad Fathi',
        ]);
        $supervisor->save();
        $supervisor->assignRole($role_supervisor);
        $supervisor->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/supervisor.png")),
        ]));
        ///////////////////////////////////////////////////////
        $supervisor = factory(\App\Models\User::class)->create([
            'username' =>  rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'supervisor1@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Enver Türkmen',

        ]);
        $supervisor->assignRole($role_supervisor);
        $supervisor->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/supervisor.png")),
        ]));
        ///////////    ///////////           ///////////           ///////////           ///////////
        /// ///////////           ///////////           ///////////           ///////////           ///////////

        $user0 = factory(\App\Models\User::class)->create([
            'username' =>  rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user0@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hasan Rıza Uzuner',

        ]);
        event(new \App\Events\UserCreated($user0));

        $user0->assignRole($role_user);
        $user0->classroom()->sync($classroom1);
        $user0->setArtifactStatus( Setting::ARTIFACT_CLUB, 0);
        $user0->setArtifactStatus( Setting::ARTIFACT_PROJECT, 0);
        $user0->setArtifactStatus( Setting::ARTIFACT_TASK, 0);
        $user0->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 0);
        $user0->setArtifactStatus( Setting::ARTIFACT_GENERAL, 0);

        $user0->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male.png")),
        ]));
        unset($user0);
        ////////////////////////////////////////////
        $user1 = factory(\App\Models\User::class)->create([
            'username' =>55555555555,
            'gender' => 1,
            'email' => 'user1@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Talha Boyraz',

        ]);
        event(new \App\Events\UserCreated($user1));

        $user1->assignRole($role_user);
        $user1->classroom()->sync($classroom1);

        $user1->setArtifactStatus( Setting::ARTIFACT_CLUB, 1);
        $user1->setArtifactStatus( Setting::ARTIFACT_PROJECT, 1);
        $user1->setArtifactStatus( Setting::ARTIFACT_TASK, 1);
        $user1->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 1);
        $user1->setArtifactStatus( Setting::ARTIFACT_GENERAL, 1);

        $user1->setCurrentXp( Setting::ARTIFACT_PROJECT, 1, 140);
        $user1->setCurrentXp( Setting::ARTIFACT_CLUB, 1, 120);
        $user1->setCurrentXp( Setting::ARTIFACT_TASK, 1, 80);
        $user1->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 1, 50);
        $user1->setCurrentXp( Setting::ARTIFACT_GENERAL, 1, 700);

        $user1->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $user1->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
        ]));
        unset($user1);
        ////////////////////////////////////////////
        $user2 = factory(\App\Models\User::class)->create([
            'username' =>66666666666,
            'gender' => 1,
            'email' => 'user2@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Arın Şüküroğlu',
        ]);
        event(new \App\Events\UserCreated($user2));

        $user2->assignRole($role_user);
        $user2->classroom()->sync($classroom2);

        $user2->setArtifactStatus( Setting::ARTIFACT_CLUB, 2);
        $user2->setArtifactStatus( Setting::ARTIFACT_PROJECT, 2);
        $user2->setArtifactStatus( Setting::ARTIFACT_TASK, 2);
        $user2->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 2);
        $user2->setArtifactStatus( Setting::ARTIFACT_GENERAL, 2);

        $user2->setCurrentXp( Setting::ARTIFACT_PROJECT, 2, 150);
        $user2->setCurrentXp( Setting::ARTIFACT_CLUB, 2, 120);
        $user2->setCurrentXp( Setting::ARTIFACT_TASK, 2, 110);
        $user2->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 2, 90);
        $user2->setCurrentXp( Setting::ARTIFACT_GENERAL, 2, 800);

        $user2->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $user2->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male4.png")),
        ]));
        unset($user2);
        ////////////////////////////////////////////
        $user3 = factory(\App\Models\User::class)->create([
            'username' =>77777777777,
            'gender' => 0,
            'email' => 'user3@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ebru Akbulut',

        ]);
        event(new \App\Events\UserCreated($user3));

        $user3->assignRole($role_user);
        $user3->classroom()->sync($classroom2);

        $user3->setArtifactStatus( Setting::ARTIFACT_CLUB, 3);
        $user3->setArtifactStatus( Setting::ARTIFACT_PROJECT, 3);
        $user3->setArtifactStatus( Setting::ARTIFACT_TASK, 3);
        $user3->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 3);
        $user3->setArtifactStatus( Setting::ARTIFACT_GENERAL, 3);

        $user3->setCurrentXp( Setting::ARTIFACT_PROJECT, 3, 120);
        $user3->setCurrentXp( Setting::ARTIFACT_CLUB, 3, 150);
        $user3->setCurrentXp( Setting::ARTIFACT_TASK, 3, 80);
        $user3->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 3, 50);
        $user3->setCurrentXp( Setting::ARTIFACT_GENERAL, 3, 1000);

        $user3->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $user3->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/female/female5.png")),
        ]));
        unset($user3);
        ////////////////////////////////////////////
        $user4 = factory(\App\Models\User::class)->create([
            'username' =>88888888888,
            'gender' => 1,
            'email' => 'user4@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Can Yücel',

        ]);
        event(new \App\Events\UserCreated($user4));

        $user4->assignRole($role_user);
        $user4->classroom()->sync($classroom3);

        $user4->setArtifactStatus( Setting::ARTIFACT_CLUB, 4);
        $user4->setArtifactStatus( Setting::ARTIFACT_PROJECT, 4);
        $user4->setArtifactStatus( Setting::ARTIFACT_TASK, 4);
        $user4->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 4);
        $user4->setArtifactStatus( Setting::ARTIFACT_GENERAL, 4);

        $user4->setCurrentXp( Setting::ARTIFACT_PROJECT, 4, 190);
        $user4->setCurrentXp( Setting::ARTIFACT_CLUB, 4, 160);
        $user4->setCurrentXp( Setting::ARTIFACT_TASK, 4, 70);
        $user4->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 4, 40);
        $user4->setCurrentXp( Setting::ARTIFACT_GENERAL, 4, 1100);

        $user4->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $user4->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male12.png")),
        ]));
        unset($user4);
        ////////////////////////////////////////////
        $user5 = factory(\App\Models\User::class)->create([
            'username' =>99999999999,
            'gender' => 1,
            'email' => 'user5@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aras Şüküroğlu',

        ]);
        event(new \App\Events\UserCreated($user5));

        $user5->assignRole($role_user);
        $user5->classroom()->sync($classroom3);

        $user5->setArtifactStatus( Setting::ARTIFACT_CLUB, 5);
        $user5->setArtifactStatus( Setting::ARTIFACT_PROJECT, 5);
        $user5->setArtifactStatus( Setting::ARTIFACT_TASK, 5);
        $user5->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 5);
        $user5->setArtifactStatus( Setting::ARTIFACT_GENERAL, 5);

        $user5->setCurrentXp( Setting::ARTIFACT_PROJECT, 5, 505);
        $user5->setCurrentXp( Setting::ARTIFACT_CLUB, 5, 370);
        $user5->setCurrentXp( Setting::ARTIFACT_TASK, 5, 260);
        $user5->setCurrentXp( Setting::ARTIFACT_QUESTION_ANSWER, 5, 140);
        $user5->setCurrentXp( Setting::ARTIFACT_GENERAL, 5, 1200);

        $user5->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

        $user5->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male7.png")),
        ]));
        unset($user5);
        ///////////           ///////////           ///////////           ///////////           ///////////
                  ///////////           ///////////           ///////////           ///////////
        $users = [];

        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user60@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Murat Akçay',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user61@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Karslı',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user62@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Tolga Işık',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user63@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sevilay Ataman',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user64@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bora Atay',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'göksel@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Göksel Kesim',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user65@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Acun Akyol',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'ercan@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ercan Altuğ Yılmaz',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'aras@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aras Şüküroğlu',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'ismail@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İsmail Çendik',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'esra@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Esra Sözen',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'elif@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Elif Baş',
        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'merve@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Öztürk',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'ayşe@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ayşe Yılmaz',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'nazlı@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nazlı Uçar',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'üstün@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Üstün',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'mesut@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Mesut Güneri',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'hüsnü@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hüsnü Çoban',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'sena@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sena Yılmaz',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'selenay@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Selenay Özaltın',
        ]);
        $users[] = $user;

        // Classroom1
        foreach ($users as $user) {
            event(new \App\Events\UserCreated($user));

            $user->assignRole($role_user);
            $user->classroom()->sync($classroom1);
            $intro = rand(0, 1);
            $index = $user->gender == 0 ? rand(1,28): rand(1,22);
            $gender = $user->gender == 0 ? 'female': 'male';
            if($intro == 1) {
                $user->setArtifactStatus( Setting::ARTIFACT_CLUB, 1);
                $user->setArtifactStatus( Setting::ARTIFACT_PROJECT, 1);
                $user->setArtifactStatus( Setting::ARTIFACT_TASK, 1);
                $user->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, 1);
                $user->setArtifactStatus( Setting::ARTIFACT_GENERAL, 1);

                $user->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
                ]));
            }
        else {
                $user->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}.png")),
                ]));
            }
        }
        unset($intro);
        unset($users);

        $users = [];

        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user6@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Fevzi Çalışkan',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user7@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Hamdi Akyol',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user8@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Selim Yıldız',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user9@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ebru Akbulut',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user10@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kerim İnan',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user11@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Okan Küçük',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user12@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yılmaz Şen',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user13@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kaan Lokumcu',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user14@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Berke Öztürk',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user15@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Çağatay Ekinci',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user16@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sarp Kaya',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user17@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Düşkuran',
        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user18@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Şengül Artıran',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user19@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Lamia Altın',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user20@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Nazlı Uçmaz',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user21@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Pelin Demirbilek',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user22@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yasemin İnce',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user23@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Handan',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user24@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Sena Karaman',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user25@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İrem Sancar',

        ]);
        $users[] = $user;
        // Classroom2
        foreach ($users as $user) {
            event(new \App\Events\UserCreated($user));

            $gender = $user->gender == 0 ? 'female': 'male';
            $index = $user->gender == 0 ? rand(1,28): rand(1,22);

            $user->assignRole($role_user);
            $user->classroom()->sync($classroom2);

            $user->setArtifactStatus( Setting::ARTIFACT_CLUB,rand(1, 2));
            $user->setArtifactStatus( Setting::ARTIFACT_PROJECT,rand(1, 2));
            $user->setArtifactStatus( Setting::ARTIFACT_TASK,rand(1, 2));
            $user->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER,rand(1, 2));
            $user->setArtifactStatus( Setting::ARTIFACT_GENERAL,rand(1, 2));

            $user->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
            ]));
        }

        unset($users);

        $users = [];

        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user26@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Metin Alpaslan',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user27@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Berk Özcan',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user28@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Garp Can Elmas',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user29@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İsa Emre Gül',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user30@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Abdullah Kuşaslan',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user31@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Kerem Onur Bekçi',

        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user32@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Enes Öncel',
        ]);
        $users[] = $user;

        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user33@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hakan Şener',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user34@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Emrecan Küçüksarı',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user35@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ahmet Yasin Yılmaz',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 1,
            'email' => 'user36@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yusuf Akyol',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user37@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Gamze Aksu',
        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user38@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Bahar Okuyucu',

        ]);
        $users[] = $user;
        ///////////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user39@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'İrem Eyüboğlu',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user40@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Merve Erdem',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user41@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Yaren Doğan',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user42@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Ceren Yalçın',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user43@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Hazal Yılmaz',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user44@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Aysu Göregen',

        ]);
        $users[] = $user;
        /////
        $user = factory(\App\Models\User::class)->create([
            'username' => rand(00000000000, 99999999999),
            'gender' => 0,
            'email' => 'user45@'.$domain_name,
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'Pınar Yarasaran',

        ]);
        $users[] = $user;
        // Classroom3
        foreach ($users as $user) {
            event(new \App\Events\UserCreated($user));

            $gender = $user->gender == 0 ? 'female': 'male';
            $index = $user->gender == 0 ? rand(1,28): rand(1,22);
            $user->assignRole($role_user);
            $user->classroom()->sync($classroom3);

            $user->setArtifactStatus( Setting::ARTIFACT_CLUB, rand(2, 5));
            $user->setArtifactStatus( Setting::ARTIFACT_PROJECT, rand(2, 5));
            $user->setArtifactStatus( Setting::ARTIFACT_TASK, rand(2, 5));
            $user->setArtifactStatus( Setting::ARTIFACT_QUESTION_ANSWER, rand(2, 5));
            $user->setArtifactStatus( Setting::ARTIFACT_GENERAL, rand(2, 5));

            $user->introductions()->attach(Introduction::lastId(), ['is_completed' => 1]);

            $user->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/user/avatar/{$gender}/{$gender}{$index}.png")),
            ]));
        }
    }
}
