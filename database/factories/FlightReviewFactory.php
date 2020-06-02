<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Flightreview;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

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

$factory->define(Flightreview::class, function (Faker $faker) {

    $airlines = array("British Airways", "Lufthansa", "Air France", "KLM", "Iberia");

    return [
        'passenger_id' => random_int(1,100),
        'airline' => Arr::random($airlines),
        'flight_number' => random_int(1,1000),
        'review_points' => random_int(1,10),
        'review_title' => $faker->sentence(),
        'review_body' => $faker->realText()
    ];
});

