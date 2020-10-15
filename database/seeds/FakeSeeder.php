<?php


use App\Models\Accessory;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        factory(Accessory::class, 10)->create()->each(function (Accessory $a) {
            $a->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/accessory/accessory.png")),
            ]));
        });
    }
}
