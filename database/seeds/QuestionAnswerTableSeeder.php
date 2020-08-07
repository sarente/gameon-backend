<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        app()->setLocale('tr');
        $category=\App\Models\Category::create([
            'text:'.app()->getLocale()=>'Sarente'
        ]);
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\QuestionTranslation::truncate();
        App\Models\Question::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = User::first();
        App::setLocale('tr');

        $question = [
            'name' => '',
            'answers' => []
        ];
        $questions = [];

        $user_id = User::orderBy('created_at', 'asc')->value('id');

        $question['name'] = 'Bir yılda kaç hafta var?';
        $question['answers'] = [
            '7',
            '12',
            '52',
            '30',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'H2O ….. formülüdür. Noktalı yere ne gelmelidir?';
        $question['answers'] = [
            'Su',
            'Hava',
            'Petrol',
            'Tuz'
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Telefonun mucidi kimdir?';
        $question['answers'] = [
            'Alexander Graham Bell',
            'Thomas Watson',
            'Nikola Tesla',
            'Benjamin Franklin',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Çanakkale Savaşı sırasında 215 kg’lık mermiyi tek başına kaldıran Türk askeri kimdir?';
        $question['answers'] = [
            'Seyit Onbaşı',
            'Hasan Onbaşı',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'İstanbul hangi coğrafi bölgemizde yer almaktadır?';
        $question['answers'] = [
            'Ege Bölgesi',
            'Marmara Bölgesi',
            'Akdeniz Bölgesi',
            'İç Anadolu Bölgesi',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Köylülerin el birliği ile köyün işini birlikte yapmalarına ne ad verilir?';
        $question['answers'] = [
            'İmece',
            'Merasim',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Depremin büyüklüğünü ve süresini ölçen alete ne ad verilir ?';
        $question['answers'] = [
            'Sismograf',
            'Tomograf',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Kızınca tüküren hayvan hangisidir?';
        $question['answers'] = [
            'Lama',
            'Panda',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Türkiye\'yi ağaçlandırmak ve erozyonla mücadele etmek olan kurulan Sivil Toplum Kuruluşu, aşağıdakilerden hangisidir?';
        $question['answers'] = [
            'Tema',
            'Tev',
            'Akut',
            'Meb',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Yazları sıcak ve kurak; kışları ise soğuk ve karlı geçen bir bölgede aşağıdaki iklimlerden hangisi görülür?';
        $question['answers'] = [
            'Karasal iklim',
            'Muson iklim',
            'Ekvatoral iklim',
            'Tropikal iklim',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Türk tarihinin en ünlü mimarı kimdir?';
        $question['answers'] = [
            'Mimar Sinan',
            'Mimar Kemaletdin',
            'Mimar Abdullah',
            'Mimar Ahmet',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Türkçe hangi dil grubuna girmektedir?';
        $question['answers'] = [
            'Ural-Altay',
            'Batı-Cermen',
            'Hint-Avrupa',
            'Çin-Tibet',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Keçinin erkeğine ne ad verilir?';
        $question['answers'] = [
            'Teke',
            'Taka',
            'Kuzu',
            'Koyun',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Gülü ile meşhur olan ilimiz hangisidir?';
        $question['answers'] = [
            'Isparta',
            'Adana',
            'Artvin',
            'Konya',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Aşağıdakilerden hangisi toprak altında büyür?';
        $question['answers'] = [
            'Havuç',
            'Kabak',
            'Kiraz',
            'Ceviz',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Aşağıdakilerden hangisi doğal ışık kaynağı değildir?';
        $question['answers'] = [
            'Mum',
            'Ateş böceği',
            'Güneş',
            'Yıldız',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Mıknatıs aşağıdakilerden hangisini çeker?';
        $question['answers'] = [
            'İğne',
            'Cam kırığı',
            'Tahta',
            'Plastik kalem',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Kaç yılda bir Şubat ayı 29 çeker?';
        $question['answers'] = [
            '4',
            '3',
            '2',
            '1',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Hangisi bir doğal sayıdır?';
        $question['answers'] = [
            '0',
            '-5',
            '1.7',
            '-2.5',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = '"Ağaç yaşken eğilir." atasözü ne ile ilgilidir?';
        $question['answers'] = [
            'Eğitim',
            'Sağlık',
            'Yardımlaşma',
            'Tutumluluk',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Hangi hayvan memeli değildir?';
        $question['answers'] = [
            'Penguen',
            'Yarasa',
            'Yunus balığı',
            'İnek',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = '\'çok-uğraşmayı-seviyordu-çiçeklerle-bahçesindeki\'
                        Verilen kelimelerle anlamlı bir cümle yapılsa aşağıdakilerden hangisi anlamlı olurdu?';
        $question['answers'] = [
            'Bahçesindeki çiçeklerle uğraşmayı çok seviyordu.',
            'Çiçeklerle çok seviyordu uğraşmayı bahçesindeki.',
            'Bahçesindeki çiçeklerle seviyordu uğraşmayı çok.',
            'Çok seviyordu bahçesindeki çiçeklerle uğraşmayı.',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'İstiklal Marşı hangi yıl yazılmıştır?';
        $question['answers'] = [
            '1919',
            '1921',
            '1918',
            '1920',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = '(120dk + 45 dk + 15 dk) kaç saat eder? ';
        $question['answers'] = [
            '7',
            '2',
            '3',
            '5',
        ];

        $questions[] = $question;
        unset($question);

        $question['name'] = 'Dünya, Güneş etrafındaki bir tam dönüşünü ne kadar sürede tamamlar?';
        $question['answers'] = [
            '1 gün',
            '1 ay',
            '1 hafta',
            '1 yıl',
        ];


        foreach ($questions as $key => $item) {
            $question = \App\Models\Question::create([
                'text' => $item['name'],
                'experience' => rand(1, 15) * 10,
                'point' => rand(1, 15) * 10,
                'user_id' => $user->id,
            ]);

            //Add sarente category
            $question->categories()->attach($category);

            foreach ($item['answers'] as $index => $answer) {
                $isAnswer = 0;
                if ($index == 0) {
                    $isAnswer = 1;
                }
                \App\Models\Answer::create([
                    'text:' . App::getLocale() => $answer,
                    'is_answer' => $isAnswer,
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}
