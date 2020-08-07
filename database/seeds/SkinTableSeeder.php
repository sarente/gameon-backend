<?php

use Illuminate\Database\Seeder;

class SkinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skins = [];

        $skins[] = \App\Models\Avatar\Skin::create([
            'color' => 0,
            'gender' => 2
        ]);

        $skins[] = \App\Models\Avatar\Skin::create([
            'color' => 1,
            'gender' => 2
        ]);

        $skins[] = \App\Models\Avatar\Skin::create([
            'color' => 2,
            'gender' => 2
        ]);

        foreach ($skins as $key => $skin) {

            $skin->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/skin/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $skin->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/skin/skin_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
