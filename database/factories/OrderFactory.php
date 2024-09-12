<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Order::class, function (Faker $faker) {
    return [
        'property_id' => factory(\App\Property::class),
        'status' => $faker->randomElement(["pending","successful","failed"]),
    ];
});
