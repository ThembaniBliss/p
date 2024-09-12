<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(PropertyLabel::class, function (Faker $faker) {
    return [
        'label_id' => factory(\App\Label::class),
        'property_id' => factory(\App\Property::class),
    ];
});
