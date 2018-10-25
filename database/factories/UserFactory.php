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
        'creator_id' => function() {
            return create('App\User')->id;
        },
        'fee' => 100,
        'type' => get_class(new \App\Office\Conference),
		'starts_at' => now()->addDay(),
		'ends_at' => now()->addDay()->addHour()
	];
});

$factory->define(App\Plan::class, function(Faker $faker) {
    return [
        'name' => $faker->word,
        'discount' => $faker->numberBetween(30, 50),
        'rate' => 10000,
        'duration' => 1
    ];
});
