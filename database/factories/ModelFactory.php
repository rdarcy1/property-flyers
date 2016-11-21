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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function () {
    static $password;

    $faker = Faker\Factory::create('en_GB');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Flyer::class, function () {

    $faker = Faker\Factory::create('en_GB');

    return [
        'user_id' => factory('App\User')->create()->id,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'state' => $faker->county,
        'country' => $faker->country,
        'price' => $faker->numberBetween(10, 500) * 5000,
        'description' => $faker->paragraphs(4, true)
    ];
});