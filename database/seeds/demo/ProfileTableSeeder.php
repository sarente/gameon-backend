<?php
namespace App\Database\Seeds\Demo;
use App\Models\Profile;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $profiles = Profile::whereHas('user.roles', function ($role) {
            $role->where('name', Setting::ROLE_USER);
        })->orderBy('id')->skip(1)->take(1000)->get();

        //$profiles=User::role(Setting::ROLE_USER)->whereNotIn('id',[1])->profile()->get();

        foreach ($profiles as $key => $profile) {
            $users = User::query()->skip(20)->inRandomOrder()->take(5)->get();

            $profile->claims()->attach($users, ['is_friend' => true]);

            $profile->tags()->attach(rand(1, 5));

            $allMedals = \App\Models\Medal::all();

            $rosetteHidden = \App\Models\Rosette::whereTranslation('name', 'Görünmez')->get();
            $rosetteIskaci = \App\Models\Rosette::whereTranslation('name', 'Iskacı')->get();
            $rosetteLost = \App\Models\Rosette::whereTranslation('name', 'Kayıp')->get();
            $rosetteSpectator = \App\Models\Rosette::whereTranslation('name', 'Seyirci')->get();
            $rosetteSoon = \App\Models\Rosette::whereTranslation('name', 'Yaklaşan')->get();

            $rosettePlanet1 = \App\Models\Rosette::whereTranslation('name', 'Gezgin')->where('level', '=', '0')->get();
            $rosettePlanet2 = \App\Models\Rosette::whereTranslation('name', 'Gezgin')->where('level', '=', '1')->get();
            $rosettePlanet3 = \App\Models\Rosette::whereTranslation('name', 'Gezgin')->where('level', '=', '2')->get();

            $rosetteWise1 = \App\Models\Rosette::whereTranslation('name', 'Bilge')->where('level', '=', '0')->get();
            $rosetteWise2 = \App\Models\Rosette::whereTranslation('name', 'Bilge')->where('level', '=', '1')->get();
            $rosetteWise3 = \App\Models\Rosette::whereTranslation('name', 'Bilge')->where('level', '=', '2')->get();

            $rosetteBanyan1 = \App\Models\Rosette::whereTranslation('name', 'Banyan')->where('level', '=', '0')->get();
            $rosetteBanyan2 = \App\Models\Rosette::whereTranslation('name', 'Banyan')->where('level', '=', '1')->get();
            $rosetteBanyan3 = \App\Models\Rosette::whereTranslation('name', 'Banyan')->where('level', '=', '2')->get();

            //$rosetteBanyanFlower = \App\Models\Rosette::whereTranslation('name', 'Çiçekli Banyan Rozeti')->get();
            $rosetteBanyanFlower = \App\Models\Rosette::whereTranslation('name', 'Banyan')->where('level', '=', '3')->get();

            $rosettes_level_1 = \App\Models\Rosette::whereTranslation('name', 'Uçan Vida')
                ->orWhereTranslation('name', 'Kanat')
                ->get();
            $medals_level_1 = \App\Models\Medal::whereTranslation('name', Setting::MEDAL_MEVLANA)
                ->orWhereTranslation('name', Setting::MEDAL_PLATON)
                ->orWhereTranslation('name', Setting::MEDAL_FATIH)
                ->orWhereTranslation('name', Setting::MEDAL_NEWTON)
                ->orWhereTranslation('name', Setting::MEDAL_FRIDA)
                ->get();

            $rosettes_level_2 = \App\Models\Rosette::whereTranslation('name', 'Uyanık')
                ->orWhereTranslation('name', 'Uyurgezer')
                ->get();
            $medals_level_2 = \App\Models\Medal::orWhereTranslation('name', Setting::MEDAL_YUNUS)
                ->orWhereTranslation('name', Setting::MEDAL_SINA)
                ->orWhereTranslation('name', Setting::MEDAL_SINAN)
                ->orWhereTranslation('name', Setting::MEDAL_SINAN)
                ->orWhereTranslation('name', Setting::MEDAL_CHARLIE)
                ->get();

            $rosettes_level_3 = \App\Models\Rosette::orWhereTranslation('name', 'Görev Bilinci')->get();
            $medals_level_3 = \App\Models\Medal::whereTranslation('name', Setting::MEDAL_EINSTEIN)
                ->orWhereTranslation('name', Setting::MEDAL_WOOLF)
                ->orWhereTranslation('name', Setting::MEDAL_TESLA)
                ->get();


            $medals_level_4 = \App\Models\Medal::orWhereTranslation('name', Setting::MEDAL_NAZIM)
                ->orWhereTranslation('name', Setting::MEDAL_HASAN)
                ->orWhereTranslation('name', Setting::MEDAL_SANCAR)
                ->get();

            $rosettes_level_5 = \App\Models\Rosette::whereTranslation('name', 'Kaşif')
                ->orWhereTranslation('name', 'Müdavim')
                ->orWhereTranslation('name', 'Yanıtkar')
                ->orWhereTranslation('name', 'Üstat')
                ->orWhereTranslation('name', 'Yükselen')
                ->get();

            switch ($profile->user->username) {
                case 55555555555:
                    $profile->rosettes()->attach($rosettePlanet1);
                    $profile->rosettes()->attach($rosetteWise1);
                    $profile->rosettes()->attach($rosetteBanyan2);
                    $profile->rosettes()->attach($rosettes_level_1);
                    $profile->medals()->attach($medals_level_1);
                    break;
                case 66666666666:
                    $profile->rosettes()->attach($rosettePlanet1);
                    $profile->rosettes()->attach($rosetteWise1);
                    $profile->rosettes()->attach($rosetteBanyan1);
                    $profile->rosettes()->attach($rosettes_level_1);
                    $profile->rosettes()->attach($rosettes_level_2);
                    $profile->rosettes()->attach($rosetteIskaci);
                    $profile->medals()->attach($medals_level_1);
                    $profile->medals()->attach($medals_level_2);
                    break;
                case 77777777777:
                    $profile->rosettes()->attach($rosettePlanet2);
                    $profile->rosettes()->attach($rosetteWise2);
                    $profile->rosettes()->attach($rosetteBanyan1);
                    $profile->rosettes()->attach($rosettes_level_1);
                    $profile->rosettes()->attach($rosettes_level_2);
                    $profile->rosettes()->attach($rosettes_level_3);
                    $profile->rosettes()->attach($rosetteIskaci);
                    $profile->rosettes()->attach($rosetteSoon);
                    $profile->medals()->attach($medals_level_1);
                    $profile->medals()->attach($medals_level_2);
                    $profile->medals()->attach($medals_level_3);
                    break;
                case 88888888888:
                    $profile->rosettes()->attach($rosettePlanet2);
                    $profile->rosettes()->attach($rosetteWise2);
                    $profile->rosettes()->attach($rosetteBanyanFlower);
                    $profile->rosettes()->attach($rosettes_level_1);
                    $profile->rosettes()->attach($rosettes_level_2);
                    $profile->rosettes()->attach($rosettes_level_3);
                    $profile->rosettes()->attach($rosetteSoon);
                    $profile->rosettes()->attach($rosetteLost);
                    $profile->rosettes()->attach($rosetteHidden);
                    $profile->rosettes()->attach($rosetteSpectator);
                    $profile->medals()->attach($medals_level_1);
                    $profile->medals()->attach($medals_level_2);
                    $profile->medals()->attach($medals_level_3);
                    $profile->medals()->attach($medals_level_4);
                    break;
                case 99999999999:
                    $profile->rosettes()->attach($rosettePlanet3);
                    $profile->rosettes()->attach($rosetteWise3);
                    $profile->rosettes()->attach($rosetteBanyanFlower);
                    $profile->rosettes()->attach($rosettes_level_1);
                    $profile->rosettes()->attach($rosettes_level_2);
                    $profile->rosettes()->attach($rosettes_level_3);
                    $profile->rosettes()->attach($rosettes_level_5);
                    $profile->rosettes()->attach($rosetteLost);
                    $profile->rosettes()->attach($rosetteSpectator);
                    $profile->medals()->attach($allMedals);
                    break;
            }

            /*$users = User::role('admin')->pluck('id');
            $profile->claims()->attach($users, ['is_friend' => false]);*/

            $users = User::role(Setting::ROLE_USER)->whereNotIn('id', [$profile->id])->pluck('id');
            $profile->claims()->attach($users, ['is_friend' => false]);

            /*$users = User::role('user')->pluck('id');
            $profile->claims()->attach($users, ['is_friend' => false]);*/

            $post = new \App\Models\Post([
                'text' => 'Bu seneki notlarım.'
            ]);

            $post->user()->associate($profile->user->id);
            $profile->posts()->save($post);

            $key = mt_rand(1, 6);
            if ($key == 3 || $key == 4) {
                $post->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/post/post_{$key}.png")),
                ]));
            } else {
                $post->image()->save(new  \App\Models\Image([
                    'image' => \Intervention::make(resource_path("images/post/post_{$key}.jpg")),
                ]));
            }
        }
    }
}
