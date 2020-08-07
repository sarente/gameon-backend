<?php

use Illuminate\Database\Seeder;

class HairTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i < 6; $i++) {
            $hair = \App\Models\Avatar\Hair::create([
                'gender' => 0
            ]);

            $hair->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/hair/female/icon_{$i}.png")),
            ]));

            for ($key = 1; $key < 4; $key++) {
                $color = new \App\Models\Avatar\ItemColor([
                    'color' => $key,
                ]);

                $hair->colors()->save($color);

                for ($index = 0; $index < 4; $index++) {
                    $posture = new \App\Models\Avatar\Posture([
                        'posture' => $index,
                    ]);

                    $posture = $color->postures()->save($posture);

                    $posture->image()->save(new  \App\Models\Image([
                        'image' => Intervention::make(resource_path("images/wear/hair/female/hair_{$i}_{$key}_{$index}.png")),
                    ]));
                }
            }
        }

        for ($i = 6; $i < 11; $i++) {
            $hair = \App\Models\Avatar\Hair::create([
                'gender' => 1
            ]);

            $hair->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/hair/male/icon_{$i}.png")),
            ]));

            for ($key = 1; $key < 4; $key++) {
                $color = new \App\Models\Avatar\ItemColor([
                    'color' => $key,
                ]);

                $hair->colors()->save($color);

                for ($index = 0; $index < 4; $index++) {
                    $posture = new \App\Models\Avatar\Posture([
                        'posture' => $index,
                    ]);

                    $posture = $color->postures()->save($posture);

                    $posture->image()->save(new  \App\Models\Image([
                        'image' => Intervention::make(resource_path("images/wear/hair/male/hair_{$i}_{$key}_{$index}.png")),
                    ]));
                }
            }
        }
    }
}
