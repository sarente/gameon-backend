<?php

use App\Models\Setting;
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
            'name' => Setting::ROSETTE_VALUES,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/values.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Selam Genç Gezgin, kahramanlığa giden yolculuk başlıyor. Heyecanın yanındaysa yola koyulalım!',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);

        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            'name' => Setting::ROSETTE_EDUCATION,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/rosette/wise.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Bilge insan, tüm koşulları hesaba katarak bağlantılar kurmaya ve sonuçlar çıkarmaya çalışır\n Arthur Schopenhauer.',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);


    }
}
