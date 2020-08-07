<?php

use Illuminate\Database\Seeder;

class HeadgearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $female_headgear_count = 5;
        $male_headgear_count = 4;
        $unisex_headgear_count = 3;

        for ($key = 0; $key < $unisex_headgear_count; $key++) {

            $headgear = \App\Models\Avatar\Headgear::create([
                'price' => 50,
                'gender' => \App\Models\Setting::GENDER_UNISEX
            ]);

            $headgear->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/headgear/unisex/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $headgear->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/headgear/unisex/headgear_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
