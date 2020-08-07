<?php

use Illuminate\Database\Seeder;

class JeansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jeanss = [];

        $jeanss[] = \App\Models\Avatar\Jeans::create([
            'price' => 100,
            'gender' => 2
        ]);

        $jeanss[] = \App\Models\Avatar\Jeans::create([
            'price' => 100,
            'gender' => 2
        ]);

        $jeanss[] = \App\Models\Avatar\Jeans::create([
            'price' => 100,
            'gender' => 2
        ]);

        $jeanss[] = \App\Models\Avatar\Jeans::create([
            'price' => 100,
            'gender' => 2
        ]);

        $jeanss[] = \App\Models\Avatar\Jeans::create([
            'price' => 100,
            'gender' => 2
        ]);

        foreach ($jeanss as $key => $jeans) {

            $jeans->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/jeans/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $jeans->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/jeans/jeans_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
