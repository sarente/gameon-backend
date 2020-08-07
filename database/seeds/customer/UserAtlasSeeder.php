<?php
namespace App\Database\Seeds\Customer;
use App\Models\Classroom;
use App\Models\Introduction;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class UserAtlasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //Get the role of admin
        $role = app(\Spatie\Permission\PermissionRegistrar::class)->getRoleClass()::findByName('admin');
        $role_student = \App\Models\Role::findByName(\App\Models\Setting::ROLE_STUDENT, 'web');
        $role_teacher = \App\Models\Role::findByName(\App\Models\Setting::ROLE_TEACHER, 'web');

        $classroom1 = Classroom::find(1);
        $classroom2 = Classroom::find(2);
        $classroom3 = Classroom::find(3);



        //Medicana
        ///////////    ///////////           ///////////           ///////////           ///////////
        /// ///////////           ///////////           ///////////           ///////////           ///////////
        $teacher = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'ogretmen@atlas.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'öğretmen',
        ]);
        $teacher->save();
        $teacher->assignRole($role_teacher);
        $teacher->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/teacher.png")),
        ]));

        /// ///////////           ///////////           ///////////           ///////////           ///////////
        $student = factory(\App\Models\User::class)->make([
            'username' => mt_rand(10000000000,99999999999),
            'gender' => 1,
            'email' => 'ogrenci@atlas.com',
            'password' => \Illuminate\Support\Facades\Hash::make('gameon'),
            'name' => 'öğrenci',
        ]);
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
        $student->image()->save(new  \App\Models\Image([
            'image' => \Intervention::make(resource_path("images/user/avatar/male/male1.png")),
        ]));


    }
}

