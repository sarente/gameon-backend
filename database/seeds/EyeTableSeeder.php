<?php

use Illuminate\Database\Seeder;

class EyeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $eyes = [];

        for ($i = 0; $i < 10; $i++) {
            $eye = \App\Models\Avatar\Eye::create([
                'color' => $i,
                'gender' => 2
            ]);

            $eye->icon()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/wear/eye/icon_{$i}.png")),
            ]));

            for ($index = 0; $index < 4; $index++) {
                $posture = new \App\Models\Avatar\Posture([
                    'posture' => $index,
                ]);

                $posture = $eye->postures()->save($posture);

                $posture->image()->save(new  \App\Models\Image([
                    'image' => Intervention::make(resource_path("images/wear/eye/eye_{$i}_{$index}.png")),
                ]));
            }
        }
    }
}
