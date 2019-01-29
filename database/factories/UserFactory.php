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
        'reference' => '1',
        'transaction_code' => $faker->uuid,
        'space_id' => function() {
            return create('App\Space')->id;
        },
        'creator_id' => function() {
            return create('App\User')->id;
        },
        'fee' => 100,
		'starts_at' => now(),
		'ends_at' => now()->addHour(),
        'participants' => 1,
        'status_id' => 0
	];
});

$factory->define(App\Plan::class, function(Faker $faker) {
    return [
        'type' => $faker->word,
        'name' => $faker->word,
        'code' => $faker->word,
        'fee' => $faker->numberBetween(100, 1000),
        'bonus_spaces' => function() {
            return create('App\Space', ['is_shared' => false])->id;
        },
        'bonus_limit' => $faker->randomDigitNotNull,
        'bonus_text' => $faker->sentence
    ];
});

$factory->define(App\Bonus::Class, function(Faker $faker) {
    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'event_id' => function() {
            return create('App\Event')->id;
        },
        'plan_id' => function() {
            return create('App\Plan')->id;
        },
        'duration' => $faker->randomDigitNotNull
    ];
});

$factory->define(App\Payment::class, function(Faker $faker) {
    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'product_id' => function() {
            return create('App\Event')->id;
        },
        'product_type' => function() {
            return get_class(create('App\Event'));
        },
        'transaction_code' => $faker->uuid
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

$factory->define(App\Membership::class, function(Faker $faker) {
    $plan = create('App\Plan', ['name' => 'semanal']);

    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'plan_id' => function() use ($plan) {
            return $plan->id;
        },
        'reference' => $faker->word,
        'next_payment_at' => $plan->renewsAt()
    ];
});
