<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Label::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'value' => $faker->word,
        'icon' => $faker->word,
    ];
});
