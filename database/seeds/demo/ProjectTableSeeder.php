<?php
namespace App\Database\Seeds\Demo;
use App\Events\ModelCreated;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        App()->setLocale('tr');
        $project = [
            'name' => '',
            'description' => '',
            'steps' => [],
            'posts' => []
        ];
        $projects = [];
        $steps = [];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Project::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user_id = User::orderBy('created_at', 'asc')->value('id');

        $project['name'] = 'Pamukta Fasülye Yetiştirme';
        $project['description'] = 'Pamuğa fasülye tohumlarını ekerek bir fasülye yetiştireceğiz.';
        $project['steps'][] = [
            'name' => 'Başlangıç',
            'description' => 'İlk aşama plastik kabın içinin pamukla kaplanmasıdır.'
        ];
        $project['steps'][] = [
            'name' => 'Gelişim',
            'description' => 'Daha sonra bir avuç fasulye pamukların arasında serpiştirilir. '
        ];
        $project['steps'][] = [
            'name' => 'Tamamlama',
            'description' => 'Son olarak pamuk su ile ıslatılır ve büyümeye bırakılır.'
        ];

        $project['posts'][] = [
            'text' => 'Fasulye deneyi için malzemeler ne arkadaşlar?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Güneş görmesi gerekiyor mu?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Fasulyeler hayat buluyor...',
            'image' => 2
        ];
        $project['posts'][] = [
            'text' => 'Günlük ne kadar su veriyorsunuz arkadaşlar?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Benim fasulyemin son hali bu sizinkiler nasıl?',
            'image' => 1
        ];
        $project['posts'][] = [
            'text' => 'Benim fasulyem çürüdü acaba yanlış bir şeyler mi yaptım?',
            'image' => 0
        ];

        $projects[] = $project;
        unset($project);

        $project['name'] = 'Askıda Kitap';
        $project['description'] = 'Okulda belirli noktalara kitap bırakılacak.';
        $project['steps'][] = [
            'name' => 'Araştırma',
            'description' => 'İhtiyacı olan okulları araştırmak.'
        ];
        $project['steps'][] = [
            'name' => 'Yürütme',
            'description' => 'Kitap toplamak.'
        ];
        $project['steps'][] = [
            'name' => 'Kapanış',
            'description' => 'Kitapları ihtiyaç sahiplerine yollamak.'
        ];

        $project['posts'][] = [
            'text' => 'Bir kaç sponsor buldum gidip konuşalım mı?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Evde okuduğunuz ve kullanmadığımız kitapları getirebiliriz. Çevrenizdekilerede söylerseniz daha çok kitaba ulaşabiliriz. Bende şunlar var.',
            'image' => 1
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar aklıma bir fikir geldi, bir etkinlik düzenleyelim ve giriş için herkes 3 tane kitap getirsin düşünceleriniz nedir?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Okul kütüphanesine bir göz atabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Askıda Kitapları yollayacağımız okulları araştırdım. Ağrı Sincan İlokulu ile iletişime geçtim. Sizde durumlar nedir?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Diğer okullardaki arkadaşlarımla da konuştum onlar da okullarında askıda kitap uygulamasına başlıyor.',
            'image' => 2
        ];

        $projects[] = $project;
        unset($project);

        $project['name'] = 'Fidan Dikme';
        $project['description'] = 'Katılımcılar 7 fidan dikecek.';
        $project['steps'][] = [
            'name' => 'Bölge Araştırması',
            'description' => 'Fidan ihtiyacı olan bölgelerin araştırılması.'
        ];
        $project['steps'][] = [
            'name' => 'Fidan Alımı',
            'description' => 'İhtiyaç doğrultusunda fidan satın alınması'
        ];
        $project['steps'][] = [
            'name' => 'Fidan Dikimi',
            'description' => 'İhtiyacı olan bölgelere dikilmesi'
        ];

        $project['posts'][] = [
            'text' => 'Hangi bölglerde fidan dikmeye başlayabiliriz?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar selam, ben fidan satın alabileceğimz bir kaç yer araştırdım. Büyük Çamlıca Fidanlığı ve Alibeyköy Fidanlığı müsait olan arkadaşlarla gidip bakabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'İstanbul Ümraniye\'de ağaçlandırma etkinliği varmış katılmak isteyen var mı?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar Tema Vakfı fidan bağışlamak isteyenler için sitesinde bir etkinlik başlatmış linki bırakıyorum. http://www.tema.org.tr/web_14966-2_1/neuralnetwork.aspx?type=141',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar ablamın okulunda fidan dikilecekmiş ben de etkinliğe gidiyorum gelmek isteyen var mı?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Fidan yardımı için Twitter\'da hashtag açtım, siz de paylaşırsanız sesimizi duyurabiliriz.',
            'image' => 0
        ];

        $projects[] = $project;
        unset($project);

        $project['name'] = 'Mavi Kapak Biriktirme';
        $project['description'] = 'Pet şişelerin kapakları biriktirilerek bir engelliye tekerlekli sandalye sağlanacak.';
        $project['steps'][] = [
            'name' => 'Alan Araştırması',
            'description' => 'Mavi kapak toplanabilecek yerlere ulaşılması'
        ];
        $project['steps'][] = [
            'name' => 'Kapak Toplama',
            'description' => 'Seçilen bölgede kapakların toplanması'
        ];
        $project['steps'][] = [
            'name' => 'Teslim',
            'description' => 'İhtiyaç sahipleri için gerekli yerlere ulaşılması'
        ];

        $project['posts'][] = [
            'text' => 'Okulda bir duyuru yapalım mavi kapak kutusu olsun her sınıfta böylece daha kolay toplayabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Heyyy ben oturduğum apartmana mavi kapak kutusu koydum.Sizlerden de bekliyorum.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar Türkiye Omurilik Felçleri Derneği\'nin   https://www.tofd.org.tr/plastik-kapak-projemiz   projesi varmış burdan da destek olabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar internette mavi kapak toplamaya dikkat çekmek için site açabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Ben annemle ve babamla konuştum çalıştığı yerlere mavi kapak kutusu koydular sizlerde ailenizle konuşursanız daha çok kişiye ulaşmış oluşuruz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'İBB\'den destek alabilir miyiz? İletişime geçelim.',
            'image' => 0
        ];

        $projects[] = $project;
        unset($project);

        $project['name'] = 'Sokak Hayvanlarına Yardım';
        $project['description'] = 'Sokaklardaki sahipsiz hayvanlara yardım eli uzatıyoruz.';
        $project['steps'][] = [
            'name' => 'İhtiyaç Belirleme',
            'description' => 'Yuva ve mama olmayan bölgelerin araştırılması'
        ];
        $project['steps'][] = [
            'name' => 'Mama Alımı',
            'description' => 'Yuva ve mama alınması'
        ];
        $project['steps'][] = [
            'name' => 'Mama Dağıtımı',
            'description' => 'Mamaların ihtiyaç sahibi bölgelere dağıtılması'
        ];

        $project['posts'][] = [
            'text' => 'Bölgedeki sokak hayvavanları tespit edelim.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Bir kaç yuva buldum ve babamla beraber sokaklara bıraktık. Sizde durumlar nedir?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkadaşlar kör bir kedi buldum, sahiplenmek isteyenler için afiş hazırlayacağım yarın okulda dağıtmama yardım edebilir misiniz?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Ben 3 tane kedi maması aldım yarın okulumuzdaki kedilere verebiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => ' Arkadaşlar, İBB sahipsiz sokak hayvanlarına 199 noktada beslenme desteği veriyormuş. Araştırarak ulaşamadıkları yerlere biz destek sağlayabiliriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Hayvan barınaklarına gezi düzenleyerek yuva arayan dostlarımıza destek olabiliriz.',
            'image' => 0
        ];

        $projects[] = $project;
        unset($project);

        $project['name'] = 'Kitap Okuma';
        $project['description'] = 'Katılımcılar proje sonunda 5 kitap bitirmiş olacaklar.';
        $project['steps'][] = [
            'name' => 'Başlangıç',
            'description' => 'Okuldaki kitap okuma oranının tespit edilmesi'
        ];
        $project['steps'][] = [
            'name' => 'Yürütme',
            'description' => 'Kütüphane oluşturma'
        ];
        $project['steps'][] = [
            'name' => 'Etkinlik',
            'description' => 'Her gün kitap okuma saati düzenlenmesi.'
        ];
        $project['steps'][] = [
            'name' => 'Bitirme',
            'description' => 'Kütüphane gezisi yapılması'
        ];

        $project['posts'][] = [
            'text' => 'Kitap okuma yarışması mı düzenlesek?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Arkaşlar ben bugün Oliver Twist okumaya başladım siz neler okuyorsunuz?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Kitaplığımdaki bütün kitapları okudum benimle kitaplarını değiştirmek isteyen var mı?',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Okul müdürümüz ile konuşup her gün kitap okuma saati olmasını isteyebililiriz.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Bugün kaç sayfa kitap okudunuz? Bakalım en çok hangimiz okumuş.',
            'image' => 0
        ];
        $project['posts'][] = [
            'text' => 'Okumaktan en çok keyif aldığınız kitap hangisi?',
            'image' => 0
        ];

        $projects[] = $project;
        unset($project);

        /*$project['name'] = 'Keşif Robotu';
        $project['description'] = 'Bir keşif robotu projesi uygulamasıdır. Robotta 6 adet DC motor, özel amortisör sistemi, RC kamera, güneş pilleri, otonom ve RF kontrollü çalışma opsiyonları gibi özellikler bulunmaktadır';
        $project['steps'][] = [
            'name' => 'ilk',
            'description' => 'adım'
        ];
        $project['steps'][] = [
            'name' => 'iki',
            'description' => 'adım'
        ];
        $project['posts'][] = [
            'text' => 'Keşif robotları hakkında araştırmayı ne zaman yapalım?',
        ];
        $project['posts'][] = [
            'text' => 'Boston Dynamicsin yaptığı robotu gördünüz mü?',
        ];

        $projects[] = $project;

        $project['name'] = 'Nanocar';
        $project['description'] = 'Nano boyutlardaki arabaları yarıştırmayı amaçladığımız eğlenceli ve bir o kadar da zor proje.';
        $project['steps'][] = [
            'name' => 'ilk',
            'description' => 'adım'
        ];
        $project['steps'][] = [
            'name' => 'iki',
            'description' => 'adım'
        ];

        $project['posts'][] = [
            'text' => 'Merhaba',
        ];
        $project['posts'][] = [
            'text' => 'Merhaba',
        ];
        $project['posts'][] = [
            'text' => 'Merhaba',
        ];
        $project['posts'][] = [
            'text' => 'Merhaba',
        ];
        $project['posts'][] = [
            'text' => 'Merhaba',
        ];
        $project['posts'][] = [
            'text' => 'Merhaba',
        ];

        $projects[] = $project;
        unset($project);*/

        foreach ($projects as $key => $item) {
            $project = new \App\Models\Project([
                'name' => $item['name'],
                'description' => $item['description'],
                'quota' => 30,
                'experience' => rand(1, 15) * 10,
                'point' => rand(1, 15) * 10,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(1),
                'user_id' => $user_id,
            ]);
            $project->save();
            event(new ModelCreated(User::find($user_id), $project));

            $project->image()->save(new  \App\Models\Image([
                'image' => \Intervention::make(resource_path("images/project/project_{$key}/project_0.jpg")),
            ]));

            $project->tags()->attach(Tag::all());

            //Add intro project to user////////////////////////////////////////
            unset($user);
            $students = User::role(\App\Models\Setting::ROLE_STUDENT)->get();
            $teachers = User::role(\App\Models\Setting::ROLE_TEACHER)->get();
            foreach ($teachers as $teacher){
                $project->users()->attach($teacher, ['is_member' => 1, 'status' => rand(0, 3)]);
                //\Log::channel('daily')->info('#project:' . $project->id . ' #user:' . $teacher->id . ' #date:' . now());
            }
            foreach ($students as $student){
                if($student->level >= $key) {
                    $project->members()->attach($student, ['is_member' => 1, 'status' => rand(0, 3)]);
                    //\Log::channel('daily')->info('#project:' . $project->id . ' #user:' . $student->id . ' #date:' . now());
                }
            }

            ///////////////////////////////////////////////////////////////////
            foreach ($item['steps'] as $i => $step) {
                \App\Models\Step::create([
                    'name' => $step['name'],
                    'description' => $step['description'],
                    'step_no' => $i,
                    'end_date' => '2020-08-07 12:50:40',
                    'project_id' =>  $project->id
                ]);
            }

            foreach ($item['posts'] as $index => $n) {
                $post = new \App\Models\Post([
                    'text' => $n['text']
                ]);
                $user = \App\Models\User::find($index + 2);
                $post->user()->associate($user);
                $project->posts()->save($post);

                if($n['image'] > 0) {
                    $post->image()->save(new  \App\Models\Image([
                        'image' => \Intervention::make(resource_path("images/project/project_{$key}/post_{$n['image']}.jpg")),
                    ]));
                }
            }
        }
    }
}
