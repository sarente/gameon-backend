<?php

namespace App\Database\Seeds\Demo;

use App\Models\Pane;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()

    {
        //Set task names
        $demo_task_names = [
            'Matematikten 20 soru çöz',
            '2 hafta içinde bir kitap bitir',
            'Etütlere/kurslara katıl',
            'Resim çiz',
            'Kompozisyon yaz',
            'Sokak hayvanlarını besle',
            'Kulüp seç',
            'Arkadaş Ekle',
            'Çiçekleri/bitkileri sula',
            'Türkçeden 30 soru çöz',
            'Kitap oku',
            'Matematikten 40 soru çöz',
            'Sinemaya git',
            'İngilizceni geliştir',
            'Odanı topla',
            'Dans et',
            'Kendinle yarış',
            'Müzeye git',
            'Huzurevi ziyareti',
        ];
        $demo_task_descriptions = [
            'Karekök kitabından 20 tane üslü sayılar çöz',
            'Hayvan Çiftliği George Orwell okuyun ve özet çıkarın.',
            'Her gün okul çıkışı soru çözümlerine katıl.',
            'Doğa temalı duygularını yansıtan bir resim çiz',
            'Bugün Türkçe dersinde işlenen konuyu ele alarak giriş-gelişme-sonuç kısımlarını barındıran bir kompozisyon yaz',
            'Haftada 2 kez evinizin önüne mama ve su koy',
            '1 hafta içinde bir kulübe üye ol',
            'Başka sınıf/şubelerden arkadaş edin',
            'Evdeki ya da dışardaki bitkileri sula.',
            '15\'i paragraf, 15\'i dil bilgisi olmak üzere günde 50 soru çöz.',
            'Her gece yatmadan önce en az 10 sayfa kitap oku',
            '20\'si üslü sayılar, 20\'si köklü sayılar olmak üzere günde 40 soru çöz.',
            'Haftada bir sinemaya git ve istediğin bir filmi izle',
            'Günde 10 İngilizce kelime öğren',
            'Dolaplarını, yatağını ve masanı topla ve odanı temizle.',
            'Bir dans/halk oyunları kursuna git',
            'Süre tutup o süre içerisinde kaç tane soru çözebildiğine bak.  ',
            'Ayda bir en az 2 müze gez.',
            'Ayda bir  arkadaşlarınla beraber huzurevlerindeki yaşlıları ziyaret et. ',
        ];
        //Set task Status 3 for demo users
        $students = User::role(\App\Models\Setting::ROLE_STUDENT)->get();

        foreach ($demo_task_names as $key => $task_name) {
            $this->addTask($students, $task_name, $demo_task_descriptions[$key], $key + 1);
        }
    }

    public function addTask($students, $task_name, $task_description, $threshold)
    {
        $task = new Task([
            'name:tr' => $task_name,
            'description:tr' => $task_description,
            'experience' => rand(1, 15) * 10,
            'point' => rand(1, 15) * 10,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addMonths(1)
        ]);
        //Creator
        $task->creator()->associate(User::find(1));
        //Pane 0 of tasks
        $level = Pane::find(13);
        $task->level()->associate($level);
        //Endorser
        $endorser = User::find(1);
        $task->endorser()->associate($endorser);
        //Create task
        $task->save();

        //Assign students according to their levels
        if ($task->id > 3) {
            foreach ($students as $student) {
                if (!in_array($student->id, [14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30])) {
                    if ($student->level == 0 && $threshold == 0) {
                        $task->members()->attach($student, ['is_completed' => 0, 'status' => 0]);
                    } else if ($threshold > 0 && $student->level * 3 >= $threshold) {
                        $task->members()->attach($student, ['is_completed' => rand(0, 1), 'status' => rand(0, 3)]);
                    }
                }
            }
        } else {
            //Intro task status change to status 3 : meaning task is done.
            foreach ($students as $student) {
                $task->members()->attach($student, ['is_completed' => 1, 'status' => 3]);
            }
        }

        return $task;
    }
}
