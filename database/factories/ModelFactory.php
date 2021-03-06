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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'login' => $faker->word,
        'fullname' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Role::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Product::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Category::class, function ($faker) {
    return [
        'name' => $faker->word,
    ];
});