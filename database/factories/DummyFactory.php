<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dummy;
use Faker\Generator as Faker;

$factory->define(Dummy::class, function (Faker $faker) {
    return [
        'name' => $this->faker->name,
    ];
});
