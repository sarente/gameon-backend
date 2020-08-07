<?php

use Illuminate\Database\Seeder;

class ShoeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoes = [];

        $shoes[] = \App\Models\Avatar\Shoe::create([
            'price' => 100,
            'gender' => 2
        ]);

        $shoes[] = \App\Models\Avatar\Shoe::create([
            'price' => 100,
            'gender' => 2
        ]);

        $shoes[] = \App\Models\Avatar\Shoe::create([
            'price' => 100,
            'gender' => 2
        ]);

        $shoes[] = \App\Models\Avatar\Shoe::create([
            'price' => 100,
            'gender' => 2
        ]);

        $shoes[] = \App\Models\Avatar\Shoe::create([
            'price' => 100,
            'gender' => 2
        ]);

        foreach ($shoes as $key => $shoe) {

            $shoe->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/shoe/icon_{$key}.png")),
            ]));

            for ($i = 0; $i < 4; $i++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $i,
                ]);

                $posture = $shoe->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/shoe/shoe_{$key}_{$i}.png")),
                ]));
            }
        }
    }
}
