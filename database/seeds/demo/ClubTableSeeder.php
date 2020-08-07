<?php
namespace App\Database\Seeds\Demo;
use App\Events\ModelCreated;
use App\Models\Badge;
use App\Models\Club;
use App\Models\ClubTranslation;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class ClubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        App()->setLocale('tr');
        $club = [
            'name' => '',
            'description' => '',
            'posts' => []
        ];
        $clubs = [];
        $steps = [];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Club::truncate();
        ClubTranslation::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user_id = User::orderBy('created_at', 'asc')->value('id');

        $club['name'] = 'Edebiyat';

        $club['description'] = 'Edebiyat Kulübü';
        $club['posts'][] = [
            'text' => 'Söylenti Dergisine bir göz atın derim, çok güzel içerikleri var.',
            'image' => 1
        ];
        $club['posts'][] = [
            'text' => 'Kütüphanede edebiyat köşesi yapabiliriz.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Edebiyat yazar-eser posterlerini hazırlayıp okuldaki panolara asabiliriz.',
            'image' => 2
        ];
        $club['posts'][] = [
            'text' => 'Okulumuz da edebiyat dergisi çıkartmak için çalışmalara ne zaman başlayacağız?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Capitol Avm de saat 17.00\'de Orhan Pamuk geliyormuş. İmza törenine gelmek isteyen var mı?',
            'image' => 3
        ];
        $club['badge'] = Badge::whereTranslation('name', Setting::CLUB_LITERATURE)->first();

        $clubs[] = $club;
        unset($club);

        $club['name'] = 'Müzik';
        $club['description'] = 'Müzik Kulübü';
        $club['posts'][] = [
            'text' => 'Müzik salonumuzun yeni hali.',
            'image' => 3
        ];
        $club['posts'][] = [
            'text' => 'Okulda hangi enstrümanlar var bilen var mı?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Arkadaşlar sevdiğiniz müzik türleri nelerdir?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Piyano dersi veren bildiğiniz yerler var mı arkadaşlar?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Şöyle bir açık hava konserine mi gitsek, çok hoş duruyor?',
            'image' => 1
        ];
        $club['posts'][] = [
            'text' => '"Deniz ve Mehtap" şarkısının notaları.',
            'image' => 2
        ];
        $club['badge'] = Badge::whereTranslation('name', Setting::CLUB_MUSIC)->first();

        $clubs[] = $club;
        unset($club);

        $club['name'] = 'Satranç';
        $club['description'] = 'Satranç Kulübü';
        $club['posts'][] = [
            'text' => 'Santranç turnuvası düzenleyelim.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Okulda santranç eksiğimiz varmış biz de destek olabiliriz.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Yeni satranç taşlarımız.',
            'image' => 2
        ];
        $club['posts'][] = [
            'text' => 'Santranç nasıl oynanır adlı bir seminer düzenlenebilir.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Perşembe günü arkadaşımın okulundaki santraç turnuvasına katılacağım gelmek isteyen olur mu?',
            'image' => 1
        ];
        $club['posts'][] = [
            'text' => 'Arkadaşlar bu akşam saat 19.00 da canlı santranç oynayacağız katılmak isteyen var mı?',
            'image' => 0
        ];
        $club['badge'] = Badge::whereTranslation('name', Setting::CLUB_CHESS)->first();

        $clubs[] = $club;
        unset($club);

        $club['name'] = 'Tiyatro';
        $club['description'] = 'Tiyatro Kulübü';
        $club['posts'][] = [
            'text' => 'Arkadaşlar Gaziosmanpaşa Sahnesi - Şehir Tiyatroları | İBB de yarın saat 14.00 da YAŞASIN BARIŞ diye bir oyun var gelmek isteyen olur mu?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Drama ve Tiyatro kursu için bir kaç kişiyle görüştüm. Öğretmenimizle konuşup okula davet edebeiliriz.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Oyunumuzdan bir kare.',
            'image' => 2
        ];
        $club['posts'][] = [
            'text' => 'Okulumuza bir tiyatro ekibi çağırabiliriz öğle arası bir gösterim olabilir.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Tiyatro nedir adlı bir seminer düzenlenebilir.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Cumartesii gideceğimiz oyun; "Woyzeck Açısı"',
            'image' => 3
        ];
        $club['badge'] = Badge::whereTranslation('name', Setting::CLUB_THEATER)->first();

        $clubs[] = $club;
        unset($club);

        $club['name'] = 'Basketbol';
        $club['description'] = 'Basketbol Kulübü.';
        $club['posts'][] = [
            'text' => 'Bugün okul takımı antremanı var mı?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => '6. ve 7. sınıflar arası basketbol maçı yapabiliriz.',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Okul takımı için basketbol seçmeleri ne zaman olacak tarihler belli mi?',
            'image' => 1
        ];
        $club['posts'][] = [
            'text' => 'Arkadaşlar yarın akşam 19.00\'da Sinan Erdem Spor Salonu\'da Anadolu Efes - Beşiktaş Sompo Japan maçı var gelmek isteyen var mı?',
            'image' => 0
        ];
        $club['posts'][] = [
            'text' => 'Željko Obradović imza töreni  yarın Akasya Avmde saat 15.00 da olacakmış toplu gidilebilir.',
            'image' => 2
        ];
        $club['posts'][] = [
            'text' => 'Yakın çevrelerde bildiğiniz basketbol kursları var mıdır?',
            'image' => 0
        ];
        $club['badge'] = Badge::whereTranslation('name', Setting::CLUB_BASKETBALL)->first();

        $clubs[] = $club;
        unset($club);

        foreach ($clubs as $key => $item) {
            $club = \App\Models\Club::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'quota' => 30,
                'classroom_id' => 1,
                'user_id' => $user_id,
                'badge_id' => $key + 1
            ]);

            event(new ModelCreated(User::find($user_id), $club));

            $club->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/club/club_{$key}/club_0.jpg")),
            ]));

            $club->tags()->sync(Tag::all());
            //Add badge of club
            $club->badge()->sync($key + 1);

            //Add intro club to user////////////////////////////////////////
            unset($user);
            $students = User::role(\App\Models\Setting::ROLE_STUDENT)->get()->take(10);
            $teachers = User::role(\App\Models\Setting::ROLE_TEACHER)->get()->take(10);
            foreach ($teachers as $teacher) {
                $club->members()->attach($teacher, ['is_member' => 1]);
                //$teacher->profile()->first()->badges()->attach($key + 1);
                //\Log::channel('daily')->info('#project:' . $club->id . ' #user:' . $teacher->id . ' #date:' . now());
            }
            //Add permission to user
            foreach ($students as $student) {
                if($student->level >= $key + 1){
                    $club->members()->attach($student, ['is_member' => 1]);
                }else{

                }

                if($student->level >= $key + 1) {
                    $student->profile()->first()->badges()->attach($key + 1);
                }
                //\Log::channel('daily')->info('#CLUB:' . $club->id . ' #user:' . $student->id . ' #date:' . now());
            }
            //Add post to club
            foreach ($item['posts'] as $index => $n) {
                $post = new \App\Models\Post([
                    'text' => $n['text']
                ]);
                $user = \App\Models\User::find($index + 2);
                $post->user()->associate($user);
                $club->posts()->save($post);

                if ($n['image'] > 0) {
                    $post->image()->save(new  \App\Models\Image([
                        'image' => \Intervention::make(resource_path("images/club/club_{$key}/post_{$n['image']}.jpg")),
                    ]));
                }
            }
        }
    }
}
