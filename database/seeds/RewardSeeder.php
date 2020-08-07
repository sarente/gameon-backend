<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Reward::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $rewards = [];

        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_PLANET . '1',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/planet/planet_1.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Selam Genç Gezgin, kahramanlığa giden yolculuk başlıyor. Heyecanın yanındaysa yola koyulalım!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_PLANET . '2',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/planet/planet_2.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Tebrikler! Artık herkesçe tanınan bir gezginsin.',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_PLANET . '3',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/planet/planet_3.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Merhaba Gezgin, seni maceralarla dolu bir yolculuk bekliyor. Hazırsan başlayalım!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_BANYAN,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_BANYAN,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/banyan/banyan.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Tebrikler!
Artık sen de Banyan’ın köklerinden birisin. Yaşamın gücü birlikten doğar
Birimiz hepimiz,hepimiz birimiz için. ',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_BANYAN,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_BANYAN_1,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/banyan/banyan_1.png")),
        ]));
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_BANYAN,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_BANYAN_2,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/banyan/banyan_2.png")),
        ]));
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Banyan',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Sınıfım adasına herhangi bir uyarı olmaksızın x gün kadar girenlere verilir. X süre Sınıfım adasına dönmezse Banyan Rozetine geri döner.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/banyan/banyan_3.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Sadakatın Yaşam kıtana yaşam kattı. Bir mucize gerçekleşti, banyanın çiçek açtı.',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);

        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_WISE,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_WISE,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/wise/wise_1.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Bilgeliğini kanıtladın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);

        unset($reward);
        /////////////////////////////////

        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_WISE,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_WISE,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/wise/wise_2.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Tebrikler! adaya ilk ulaşan senin takımın oldu. Zirveden aşağısı nasıl görünüyor :D',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_WISE,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_WISE,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/wise/wise_3.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Piri Reis gibisin adaya vardın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        /// FIXME: set name in Setting
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Görev Bilinci',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'X kadar görev yapınca kazanılır. Kalıcı ve gelişen rozetlerden. Asla düşmez.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/gorev_bilinci.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Sende tartışmasız görev bilinci hakim!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Görev bilinci senin diğer adın, harikasın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Görev Bilincine erişmiş olduğun ortada da olsa gelişim bitmez daha çok çalış ötesine geç!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Kanat',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Bir kulübe katılınca beyaz kanat kazanılır.(eylemlerle renklenecek) Bir kulübe üye olduğu sürece kalır.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/kanat.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Ayakların yerden kesildi!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Artık kanatları olan bir gezginsin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Keşfe kanat çırp!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Kaşif',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Meydan adasına ulaşınca kazanılır. Sene sonunda kazanılan  ve düşmeyen rozettir.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/kasif.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Gezegende ayak basılmadık yer bırakmadın; gerçek bir kaşifsin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Müdavim',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'X gün giriş yapan kazanır(Her gün artan sayı). 1 gün girmeyince 0 lanır.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/mudavim.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Varlığın bu gezegen için lütuf. İyi ki varsın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Varlığınla gezegeni aydınlatan bir meşale gibisin, hep ışılda!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Uçan Vida',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'İlk projeye katıldığında kazanılır. Projede bulunduğu sürece kalır.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/ucan_vida.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Artık Leonardo Da Vinci de sana inanıyor. Bilimle sanat, mantıkla hayalgücü arasında denge geliştirebilecek dehaya sahipsin.',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Büyük keşifler, küçük bir fikirle başlar. Unutma Da Vinci\'nin icadı "Uçan Vida" helikopterin atası.',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Üstat',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'X kadar doğru cevap veren kazanır. (Doğru Cevap Kombocusu) İlk yanlış cevap veya cevap vermeme durumunda düşer.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/ustat.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Dünyayı okumayı öğrenmiş olmalısın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Doğru cevaplarla yol alınsaydı Çin Seddi\'ni geçmiştin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Sen tartışmasız üstatsın, tebrikler!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Uyanık',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Sisteme 7:30-8:00 arası login olan kişilere verilir. X gün belirtilen saatlerde giriş yapılmadığında rozet düşer.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/uyanik.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Günaydın, erkencisin :) biz de seni bekliyorduk!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Gün erken kalkanındır, erken kalkan yol alır :)  Tebrikler!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Günaydın, hayalleri gerçekleştirmenin en iyi yolu, uyanmaktır. rastgele!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Uyurgezer',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Sisteme 21.00 - 23.30 arası login olan kişilere verilir. X gün belirtilen saatlerde giriş yapılmadığında rozet düşer.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/uyurgezer.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Uyku tutmamış, belli ki yapacakların var Uyurgezer!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Haklısın burası tam bir rüya gezegeni :)',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Sen tam bir Uyurgezersin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Yükselen',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Xp ortalamasının üzerinde xp"si olan kazanır. Ortalamanın altına düşünce rozet düşer.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/yukselen.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Sen yükselen bir değersin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Tebrikler! Başarıların sınırları aşıyor!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Kalın giyin, yükseklerde hava soğuk olur! :)',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => Setting::ROSETTE_HIDDEN,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => Setting::ROSETTE_HIDDEN,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/hidden.png")),
        ]));
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Yaklaşan',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => '(Soru-Cevap Kombocusu) X gün cevap veren kazanır. 1 gün cevap verilmediğinde kaybedilir.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/yaklasan.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Gayret et, yükselen ol!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Sen bu kadar değilsin, silkelen ve potansiyelini açığa çıkar!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Azimle yürüyenler, zirveyi görenlerdir. Gayret et, kendini aş! ',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Seyirci',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Negatif rozettir.Login oluyor, X adet tamamlanmamış görevi olmasına rağmen yapmayınca alınır.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/seyirci.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Korkarak yaşıyorsan yalnızca hayatı seyredersiiiin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Seyretmeyi bırak, sahneye çık, harikalar yaratabilirsin!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'Orda olduğunu biliyorum, göster kendini, varlığını kanıtla!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Kayıp',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Negatif Rozettir. X gün girmeyince alınır. Giriş yapmadığı x günden sonra sisteme giriş yaptığı ilk gün yok olur.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/kayip.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Senin için kayıp ilanı verdik. Umarız en kısa zamanda bulunursun!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            //'name' => 'Iskacı',
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Negatif rozettir. X kadar yanlış yapınca alınır. İlk doğru cevapla yok olur.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/iskaci.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Haklısın, yanlışlama bir öğrenme tekniğidir. Ama artık öğrenmiş olmalısın!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        $message = \App\Models\Message::create([
            'message' => 'İnsan alışabilen bir varlık; belli ki yanlış cevap vermeye alıştın. Sen yine de şunu aklından çıkarma: alışkanlık kader değildir ve sen de kurtulabilirsin! ',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
        /////////////////////////////////
        ///
        ///
        $col_medals = collect();
        $models = [];

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Charlie Chaplin',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Sinema oyuncusu.',
        ]);
        $models['message']=\App\Models\Message::find(30);
        $col_medals->push($models);
        unset($models);


        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Frida Kahlo',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Ressam.',
        ]);
        $models['message']=\App\Models\Message::find(22);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Fatih Sultan Mehmet',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Fatih.',
        ]);
        $models['message']=\App\Models\Message::find(32);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Hasan Ali Yücel',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Eğitimci.',
        ]);
        $models['message']=\App\Models\Message::find(19);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Isaac Newton',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Polymath.',
        ]);
        $models['message']=\App\Models\Message::find(21);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Marie Curie',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Bilim İnsanı.',
        ]);
        $models['message']=\App\Models\Message::find(29);
        $col_medals->push($models);
        unset($models);

        //6
        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Mimar Sinan',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Mimar.',
        ]);
        $models['message']=\App\Models\Message::find(57);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Albert Einstein',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Bilim İnsanı',
        ]);
        $models['message']=\App\Models\Message::find(39);
        $col_medals->push($models);
        unset($models);

        //8
        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Aziz Sancar',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Bilim İnsanı',
        ]);
        $models['message']=\App\Models\Message::find(34);
        $col_medals->push($models);
        unset($models);

        //9
        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Platon',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Düşünür',
        ]);
        $models['message']=\App\Models\Message::find(18);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Virginia Woolf',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Yazar',
        ]);
        $models['message']=\App\Models\Message::find(31);
        $col_medals->push($models);
        unset($models);
//
        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Mevlana',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Şair',
        ]);
        $models['message']=\App\Models\Message::find(25);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Nazım Hikmet',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Şair',
        ]);
        $models['message']=\App\Models\Message::find(44);
        $col_medals->push($models);
        unset($models);

        $models['medal'] = \App\Models\Reward::create([
            //'name:tr' => 'Yunus Emre',
            'type' => Setting::REWARD_MEDAL,
            //'description:tr' => 'Şair',
        ]);
        $models['message']=\App\Models\Message::find(58);
        $col_medals->push($models);

        $col_medals->each(function ($item, $key){
            $item['medal']->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/medal/{$key}.png"))
            ]));

            //Messages
            if (key_exists('message',$item) && !is_null($item['message'])) {
                $item['medal']->messages()->save($item['message']);
            }
        });


        $models = [];

        $models[] = \App\Models\Reward::create([
            //'name' => 'Edebiyat',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Edebiyat klubünün simgesi.',
        ]);
        $models[] = \App\Models\Reward::create([
            //'name' => 'Müzik',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Müzik klubünün simgesi.',
        ]);
        $models[] = \App\Models\Reward::create([
            //'name' => 'Satranç',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Satranç klubünün simgesi.',
        ]);
        $models[] = \App\Models\Reward::create([
            //'name' => 'Tiyatro',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Tiyatro klubün simgesi.',
        ]);
        $models[] = \App\Models\Reward::create([
            //'name' => 'Basketbol',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Basketbol klubünün simgesi.',
        ]);
        $models[] = \App\Models\Reward::create([
            //'name' => 'Kulüplerim',
            'type' => Setting::REWARD_BADGE,
            //'description' => 'Öntanımlı kulüp simgesi.',
        ]);

        foreach ($models as $key => $badge) {
            $badge->image()->save(new  \App\Models\Image([
                //'image' => Intervention::make(resource_path("images/badge/rosette_{$key}.png")),
                'image' => Intervention::make(resource_path("images/badge/{$key}.png")),
            ]));
        }
    }
}
