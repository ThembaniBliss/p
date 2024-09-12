<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Property::class, function (Faker $faker) {
    return [
        'owner_id' => factory(\App\Owner::class),
        'location_id' => factory(\App\Location::class),
        'description' => $faker->text,
        'rental_fee' => $faker->randomFloat(2, 0, 999999.99),
        'rental_deposit' => $faker->randomFloat(2, 0, 999999.99),
        'rental_negotiable' => $faker->randomElement(["yes","no"]),
        'rooms' => $faker->numberBetween(-10000, 10000),
        'beds' => $faker->numberBetween(-10000, 10000),
        'accommodation_type' => $faker->word,
    ];
});
