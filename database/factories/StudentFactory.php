<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use {{ namespacedModel }};

$factory->define(Student::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class),
        'firstname' => $faker->firstName,
        'surname' => $faker->word,
        'idnumber' => $faker->word,
        'phone' => $faker->phoneNumber,
        'image' => $faker->text,
    ];
});
