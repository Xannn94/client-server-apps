<?php

use App\Employee;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'fio' => $faker->firstName . $faker->lastName,
        'pin' => Str::random(6),
        'phone' => $faker->unique()->phoneNumber,
        'address' => $faker->unique()->address,
        'status' => rand(0,1)
    ];
});
