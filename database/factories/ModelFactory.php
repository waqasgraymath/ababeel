<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'phone' => $faker->PhoneNumber,
        'country_code' => $faker->countryCode,
        'time_zone' => $faker->timezone,
        'verification_code' => $faker->randomDigitNotNull,
        'is_verified' => rand(0, 1),
        'remember_token' => str_random(10),
    ];
});
