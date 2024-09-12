<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Gallery::class, function (Faker $faker) {
    return [
        'image_id' => factory(\App\Image::class),
        'property_id' => factory(\App\Property::class),
        'main' => $faker->word,
    ];
});
