<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'user_id' => random_int(1,100),
        'title' => $faker->realText(45, 2),
        'article' => $faker->text,
        'published' => $faker->boolean
    ];
});
