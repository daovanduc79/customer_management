<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dob' => $faker->date(),
        'email' => $faker->unique()->safeEmail
    ];
});
