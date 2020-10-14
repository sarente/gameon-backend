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
        //Degerler
        $reward = \App\Models\Reward::create([
            'name' => Setting::ROSETTE_VALUES,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/reward/values.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'ilk değeri bilince Değerli rozeti',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);

        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            'name' => Setting::ROSETTE_VALUES,
            'type' => Setting::REWARD_MEDAL,
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/reward/jobs.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => '2. değeri bilince de bu madalyonu kazansın',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);

        //Yetkinlikler
        /////////////////////////////////
        $reward = \App\Models\Reward::create([
            'name' => Setting::ROSETTE_COMPETENCE,
            'type' => Setting::REWARD_ROSETTE,
            //'description' => 'Gezgin Rozeti.',
        ]);
        $reward->image()->save(new  \App\Models\Image([
            'image' => Intervention::make(resource_path("images/reward/wise.png")),
        ]));
        $message = \App\Models\Message::create([
            'message' => 'Yetkinliklerde de yetkin rozeti alacak',
            'message_type' => Setting::DONE_MESSAGE,
        ]);
        $reward->messages()->save($message);
        unset($reward);
    }
}
