<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'telegram_id' => $faker->numberBetween(0, 1000000),
        'current_shop' => null,
        'is_admin' => true,
        'username' => $faker->userName,
        'remember_token' => Str::random(10),
    ];
});
