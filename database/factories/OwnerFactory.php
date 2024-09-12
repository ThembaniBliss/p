<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'firstname' => $faker->firstName,
        'surname' => $faker->word,
        'address' => $faker->word,
        'image' => $faker->word,
    ];
});
