<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Accessory::class, function (Faker $faker) {
    return [
        //'name:' . App::getLocale() => $faker->name,
        //'description:' . App::getLocale() => $faker->text,
        'name:en'  => \Faker\Factory::create('en_US')->name,
        'name:tr'  => \Faker\Factory::create('tr_TR')->name,
        'description:en' =>\Faker\Factory::create('en_US')->text,
        'description:tr' =>\Faker\Factory::create('tr_TR')->text,
    ];

});
