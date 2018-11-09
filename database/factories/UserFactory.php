<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function(Faker $faker) {
	return [
        'space_id' => function() {
            return create('App\Space')->id;
        },
        'creator_id' => function() {
            return create('App\User')->id;
        },
        'fee' => 100,
		'starts_at' => now()->addDay(),
		'ends_at' => now()->addDay()->addHour()
	];
});

$factory->define(App\Plan::class, function(Faker $faker) {
    return [
        'type' => $faker->word,
        'name' => $faker->word,
        'fee' => $faker->numberBetween(100, 1000),
        'benefits' => $faker->sentence
    ];
});

$factory->define(App\Space::class, function(Faker $faker) {
    return [
        'slug' => $faker->word,
        'type' => $faker->word,
        'nickname' => $faker->word,
        'capacity' => $faker->randomDigitNotNull,
        'fee' => $faker->numberBetween(100,1000),
        'is_shared' => $faker->boolean(50)
    ];
});
