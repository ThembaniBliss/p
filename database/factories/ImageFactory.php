<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Image::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'filename' => $faker->word,
        'type' => $faker->word,
    ];
});
