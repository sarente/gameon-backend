<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()->setLocale('tr');
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Merhaba Gezgin, serüvene hoşgeldin :) Şimdi seninle yeni yerler keşfedeceğiz. Bu yolculukta sana gördüğün yerleri ben tanıtacağım. Hadi, Başla butonuna tıkla, başlayalım.',
            'message_type' => 0,
        ]);

        app()->setLocale('tr');
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Kendi dünyanı geliştirmen için sana el değmemiş bir dünya sunuyoruz. Bu dünyada 7 kıta bulunuyor. Kıtalarını adım adım geliştirerek medeniyetini kurabilirsin. Kıtaların her aşamasında sana ilham kaynağı olacak bir bilge ile karşılaşacaksın ve bilgeler arka arkaya eklenerek Deha Zincirini oluşturacaklar.',
            'message_type' => 0,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Dünyan hakkında henüz fazla bir şey bilmiyorsun ama endişelenme. Sana yardımcı olacak bir arkadaşın var: Orbit.',
            'message_type' => 0,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Hoş geldin Gezgin! Ben Orbit! Meydan kıtasındaki kilidi gördün mü? Bu kilidi açmak diğer kıtaları geliştirip Deha Zincirini tamamlamalısın. Şimdi, kıtaları daha iyi tanımak için biraz yolculuğa ne dersin?',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Hazırsan serüven başlıyor. Görevler Kıtasına hoş geldin! Bu kıtada medeniyeti ilerletmenin yolu verilecek görevleri tamamlamaktan geçiyor. Üstelik avatarında kullanabileceğin aksesuar ve rozetler de cabası.. O da ne! Ada senin için parlıyor, ilk görevini yapmak için tıklamaya ne dersin?',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Hadi başlayalım! İlk görevin; yeni dünyaya kendini tanıtmak! Böylece Deha Zincirinin sırlarına bir adım daha yaklaşacaksın.',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler! Artık herkesçe tanınan bir gezginsin.',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Sırada 2.görevin var. Şimdi de, senin gibi kendi dünyasını geliştirmek isteyen arkadaşların neler yapmış onlara bakalım mı? Hadi "Göreve Tıkla!"',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler! Diğer gezgin dostlarını tanımış oldun.',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Deha zincirinin ilk halkası sende. Soruya cevap ver dehanı göster.',
            'message_type' => 0,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Burası da Soru-Cevap kıtası.Bu kıtada sana hergün bir soru çıkacak ve verdiğin doğru cevaplarla rozet veya aksesuar kazanabileceksin. Senin için parıldayan kıtaya tıklayarak ilk soruyu görebilirsin."',
            'message_type' => 0,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Güldürmedi! Yeniden dene şakacı Gezgin.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Doğru cevabı bulmak senin için çok kolay olmalı.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler, ilk aşamayı başarıyla tamamladın! Artık seni Meydan kıtasına taşıyacak serüvene başlayabilirsin. Serüvenin boyunca her aşamada Deha Zincirine yeni bir bilge eklenecek. Zinciri tamamladığında Meydan kıtası seni bekliyor olacak.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Acele etme! Suda yürüme yetisini kazanmadan bu kıtaya gidersen Arşimet seni denize atar ve batmanı izler. Suda yürüme eğitimine geç',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Projeler kıtasına hoş geldin! Gezegenini geleceğe taşıyacak fikirlerin bu kıtada yeşerecek. Bu kıtada projeler oluşturabilecek, sana verilen projeleri geliştirip, projede birlikte görev aldığın arkadaşlarınla paylaşabileceksin.',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Kulüpler kıtasına hoş geldin! Bu kıtada diğer gezgin dostlarınla kulüp aktivitelerinde bulunarak medeniyeti yayacaksın.',
            'message_type' => 1,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => '"Her şeyin en mühim noktası, başlangıçtır." Sen de iyi bir başlangıç yaptın, Eflatun artık seninle. Bilgi Kıtası\'nda da muhteşem bir başlangıç yaptın! "Her şeyin en mühim noktası, başlangıçtır." Der Büyük düşünür ve matematik dehası Eflatun, İşte tam bu yüzden o da yolunu açmak için yol arkadaşın olanlardan sadece biri! Böyle devam edersen yolunun kesişeceklerine ve ilerlemelerine sen bile şaşıracaksın!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => ' İmkansızı tanımayanlar fark yaratır, öyle ki: bazıları çağ kapatır, çağ açar... Tıpkı Fatih Sultan Mehmet gibi... İmkanın sınırını görmek için imkansızı denemek lazım. Öyle görünüyor ki senin için de imkansız diye bir şey yok. Bu özelliğin Deha Zincirine Fatih\'i de kattı. ',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler. Gezegeninde ikinci aşamayı da başarıyla tamamladın!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => '"Eğer daha ileriyi gördüysem, devlerin omuzlarında durduğum içindir" Kıtan gelişti ama daha da geliştirmek için senden önceki dev bilginlerden faydalanmayı unutma! Bilim dünyasının devlerinden Isaac Newton da artık yanında!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Hayata geçirdiklerin için Kolektya sana minnettar. Ayrıca ünlü ressam Frida da sana inanıyor.  "Kanatların varken neden ayaklarına ihtiyaç duyasın?" diyor . Hadi kanatları açma vakti; çok daha iyisini yapabilirsin! ',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Günaydın, hayalleri gerçekleştirmenin en iyi yolu, uyanmaktır. Yolun açık olsun!',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Haklısın burası adeta bir rüya gezegeni :) ',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bilgeliğini kanıtladın!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'En uzun yolculuklar küçük bir adımla başlar. Tıpkı helikopterin atası uçan vida gibi.',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler bu kadar kısa sürede kıtana çağ atlatınca büyük düşünür ve tıp insanı İbni Sina da seni şöyle taktir etti:  "Aklı bol olan, zamanın kıtlığından zarar görmez." Artık İbni Sina da yol arkadaşlarından biri!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Harikasın! Yeteneklerini tutkuyla birleştirmeye başladın! Nicola Tesla buna o kadar önem veriyor ki, bu yolculukta seninle yürümeye karar verdi!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => '"Yaşamda hiçbir şeyden korkulmaz. Sadece onu anlamak gerekir." Korkusuz bir gezgin olma yolunda emin adımlarla yürüyorsun. Bu yolda yalnız değilsin. Marie Curie ile tanış',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler. Sevgi ve bağlılık ile gelişmeye ve geliştirmeye devam ediyorsun. Ünlü komedyen Charlie Chaplin "Gülümsemediğin bir gün, kaybolmuş bir gündür" diyerek deha zincirinin neşe halkası olarak sana elini uzatıyor.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bravo yine bilgini kanıtladın. Üzerine düşünülmeyen bilgi seni hiçbir yere taşımaz çünkü "Düşünceler kutsaldır." Deha zincirine yeni katılan Yazar Virginia Woolf, bu konuda sana destek olmak için artık seninle.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler! Bilgi Kıtası\'nı en üst seviyeye kavuşturdun! Hasan Ali Yücel de artık seninle. Bir kulak verelim ne diyor. "İnsan olarak yaşayabilmek için hava, su gibi doğal koşullar arasında eğitim, öğretim ve kültür de bulunacaktır."',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Harikasın! Yeteneklerini tutkuyla birleştirmeye başladın! İlklerin insanı, mucit ve bilim devi Nicola Tesla buna o kadar önem veriyor ki, bu yolculukta seninle yürümeye karar verdi!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler! Çalışmanın önemini biliyorsun. Aziz Sancar da sendeki bu azmi gördü ve yolculuğunda yanında olacak dahilerin arasına katıldı. "Başarı, zeka kadar çalışmakla elde edilir. Sebat lazım, inat etmek lazım ve çalışmak lazım."',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler. Zorlu bir görevin daha üstesinden geldin.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bravo. Doğru cevap vermeyi alışkanlık haline getirdin.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Üzülme! Bir dahaki sefere doğru cevapla geleceğinden hiç kuşku yok!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Harikasın! Sorumluluk aldın ve başardın.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler çok çalıştın ve başardın. ',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Görev bilincin ve azmin gerçekten takdire şayan!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'İşte başarı! Her sorunun cevabı sende var!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bazen doğruya ulaşmak için hata yapmak gerekebilir. Önemli olan hatalardan ders çıkarabilmektir.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bu kadar zor bir projeyi başardığın için kendinle gurur duymalısın!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => '"Tebrikler genç dahi. Muhteşem bir performans gösterdin. Ünlü Şair Nazım Hikmet  ""Bu dünya güzelse senin yüzünden"" diyor ve artık o da deha zincirinin bir parçası!"',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => '"Arkadaşlık ağaca benzer, kurudu mu bir daha yeşermez." Yaşam kıtana git, dostluklarını besle ve banyan\'nın kurumasına engel ol!',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Yokluğun banyan\'a zarar veriyor. Kıtadaki yaşamın devamlılığı için canlılığa el ver, Yaşam kıtanı ziyaret et."Yaşamak bir ağaç gibi tek ve hür ve bir orman gibi kardeşçesine…."   ',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Sadakatın Yaşam Kıtana yaşam kattı. Bir mucize gerçekleşti, banyanın çiçek açtı.',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Henüz çok erken! Önce seni Kadim Kıta\'ya taşıyacak Deha Zinciri\'ni tamamlamalısın!',
            'message_type' => 2,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Çok iyi iş çıkardın! Deha zincirini tamamladın, bütün yolları kat ettin. Böylece Kadim Kıta Mu tarafından kabul edildin. Sen bu kıtaya yaşam verecek isimsin. Artık Kadim Kıta Mu da seni ödüllendirmek istiyor!',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Dünyaya kendini tanıtmak için hakkımda kısmında kendinden bahseder misin? Ayrıca gezgin dostlarının seni daha iyi tanıması için ilgi alanlarını seçmeyi de unutma.',
            'message_type' => 3,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Şimdi de avatarını düzenle butonuna tıklayarak kendine bir görünüş oluştur. Bu görünüşün diğer gezgin dostlarının seni tanımasını sağlayacak.',
            'message_type' => 3,
        ]);
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Duvarım kıtasına hoş geldin! Bu kıtada arkadaşlarının paylaşımlarını Pano da görebilecek, bu paylaşımları sen de paylaşıp beğenebileceksin. Ayrıca sana gelen bildirimleri de Bildirim başlığı altında görebilirsin.',
            'message_type' => 1,
        ]);
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Evet! Burası da Meydan. Adaları keşfettikçe ulaşabileceğin büyük hedefin! Meydan\'da seni bekleyen büyük sürpriz aslında tüm yolculuğuna değecek. Hodri Meydan!',
            'message_type' => 1,
        ]);
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler, ilk aşamayı başarıyla tamamladın! Artık seni Meydan kıtasına taşıyacak serüvene başlayabilirsin. Serüvenin boyunca her aşamada Deha Zincirine yeni bir bilge eklenecek. Zinciri tamamladığında Meydan kıtası seni bekliyor olacak.',
            'message_type' => 2,
        ]);

        /////////////////////////////
        /// Question Answer return message to user right/wrong  answer
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Doğru Cevap!',
            'message_type' => Setting::RIGHT_MESSAGE,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Cevabın Yanlış',
            'message_type' => Setting::WRONG_MESSAGE,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Bu yolda inanarak yürüdüğünü görenler çoğalıyorlar ve sana inanıp seninle yürümek istiyorlar. Şimdi sıkı dur ve tüm zamanların en büyük mimarının sana mesajına kulak ver!  "Yaptığın işi gönlünde hissedersen, ırmaklar çağlar içinde" Yolunu artık Mimar Sinan da aydınlatacak.',
            'message_type' => Setting::POPUP_MESSAGE,
        ]);

        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Tebrikler. Artık insanlar seni tanımaya başladı. Hatta Anadolu\'nun kahramanı, şair Yunus Emre de bu yolculukta yanında olmaya karar verdi ve şöyle dedi: "Bilmeyen ne bilsin bizi bilenlere selam olsun."  ',
            'message_type' => Setting::POPUP_MESSAGE,
        ]);
        //OnBoarding Avatar studio message
        \App\Models\Message::create([
            'message:' . app()->getLocale() => 'Avatar Düzenleme ekranına hoş geldin! Kendine has bir görünüş oluştur ve kaydetmeyi unutma!',
            'message_type' => Setting::POPUP_MESSAGE,
        ]);
    }
}
