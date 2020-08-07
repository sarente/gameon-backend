<?php

use Illuminate\Database\Seeder;

class DressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dresses = [];

        $dresses[] = \App\Models\Avatar\Dress::create([
            'price' => 100,
            'gender' => 0
        ]);

        $dresses[] = \App\Models\Avatar\Dress::create([
            'price' => 100,
            'gender' => 0
        ]);

        $dresses[] = \App\Models\Avatar\Dress::create([
            'price' => 100,
            'gender' => 0
        ]);

        foreach ($dresses as $key => $dress) {

            $dress->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/dress/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $dress->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/dress/dress_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
