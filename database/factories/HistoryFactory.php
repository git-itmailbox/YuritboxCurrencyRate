<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\History;
use Faker\Generator as Faker;

$factory->define(History::class, function (Faker $faker) {
    return [
        History::FIELD_VALUE => $faker->numberBetween(100000,11000000),
        History::FIELD_NOMINAL => $faker->numberBetween(100000,11000000)
    ];
});
