<?php

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'locale'      => 'tr',
            'native'      => 'Türkçe',
            'english'     => 'Turkish',
            'is_required' => true,
        ]);

        Language::create([
            'locale'      => 'en',
            'native'      => 'English',
            'english'     => 'English',
            'is_required' => false,
        ]);

        Language::create([
            'locale'      => 'de',
            'native'      => 'Deutsch',
            'english'     => 'German',
            'is_required' => false,
        ]);

        Language::create([
            'locale'      => 'es',
            'native'      => 'Español',
            'english'     => 'Spanish',
            'is_required' => false,
        ]);

        Language::create([
            'locale'      => 'uk',
            'native'      => 'Yкраїнська',
            'english'     => 'Ukrainian',
            'is_required' => false,
        ]);

        Language::create([
            'locale'      => 'ru',
            'native'      => 'Pусский',
            'english'     => 'Russian',
            'is_required' => false,
        ]);
    }
}
