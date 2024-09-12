<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Location::class, function (Faker $faker) {
    return [
        'order' => $faker->numberBetween(-10000, 10000),
        'title' => $faker->sentence(4),
    ];
});
