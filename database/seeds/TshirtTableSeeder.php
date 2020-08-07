<?php

use Illuminate\Database\Seeder;

class TshirtTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $female_tshirt_count = 5;
        $male_tshirt_count = 4;
        $unisex_tshirt_count = 2;

        for ($key = 0; $key < $female_tshirt_count; $key++) {

            $tshirt = \App\Models\Avatar\Tshirt::create([
                'price' => 100,
                'gender' => 0
            ]);

            $tshirt->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/tshirt/female/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $tshirt->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/tshirt/female/tshirt_{$key}_{$i}.png")),
                ]));
            }
        }

        for ($key = 0; $key < $male_tshirt_count; $key++) {

            $tshirt = \App\Models\Avatar\Tshirt::create([
                'price' => 100,
                'gender' => 1
            ]);

            $tshirt->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/tshirt/male/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $tshirt->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/tshirt/male/tshirt_{$key}_{$i}.png")),
                ]));
            }
        }

        for ($key = 0; $key < $unisex_tshirt_count; $key++) {

            $tshirt = \App\Models\Avatar\Tshirt::create([
                'price' => 100,
                'gender' => 2
            ]);

            $tshirt->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/tshirt/unisex/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $tshirt->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/tshirt/unisex/tshirt_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
