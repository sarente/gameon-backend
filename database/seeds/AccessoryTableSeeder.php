<?php

use App\Models\Profile;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AccessoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        //First of all add permission to db then create roles thus connect the permission to related role
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        App\Models\Accessory::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $Accessorys = [];

        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Kravat',
            'description:tr' => 'En çok puan kazanan alır.',
        ]);

        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Plaj Çantası',
            'description:tr' => 'Kimyada başarılı olanlar kazanır.',
        ]);

        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Çanta',
            'description:tr' => 'Gezginlere verilir.',
        ]);

        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Evrak Çantası',
            'description:tr' => 'Aktif kişilere verilir.',
        ]);

        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Küpe',
            'description:tr' => 'En çok doğru cevap veren kazanır.',
        ]);
        $Accessorys[] = \App\Models\Accessory::create([
            'name:tr' => 'Gözlük',
            'description:tr' => 'En çok doğru cevap veren kazanır.',
        ]);

        foreach($Accessorys as $key => $Accessory){
            $Accessory->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/accessory/accessory_{$key}.png")),
            ]));
        }
    }
}
