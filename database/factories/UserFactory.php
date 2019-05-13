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
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'area_code' => 21,
        'phone' => $faker->tollFreePhoneNumber,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'role' => 'manager',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Event::class, function(Faker $faker) {
	return [
        'reference' => $faker->swiftBicNumber,
        'transaction_code' => $faker->uuid,
        'space_id' => function() {
            return create('App\Space')->id;
        },
        'creator_id' => function() {
            return create('App\User')->id;
        },
        'creator_type' => 'App\User',
        'fee' => $faker->numberBetween(35,250),
		'starts_at' => now(),
		'ends_at' => now()->addHour(),
        'participants' => 1,
        'status_id' => 0
	];
});

$factory->define(App\Bill::class, function(Faker $faker) {
    return [
        'creator_id' => function() {
            return create('App\Admin')->id;
        },
        'recipient_name' => $faker->firstName . ' ' . $faker->lastName,
        'recipient_email' => $faker->email,
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'reference' => $faker->swiftBicNumber,
        'transaction_code' => $faker->uuid,
        'fee' => $faker->numberBetween(35,250),
        'status_id' => 0
    ];
});

$factory->define(App\Plan::class, function(Faker $faker) {
    return [
        'type' => $faker->word,
        'name' => $faker->word,
        'fee' => $faker->numberBetween(100, 1000),
        'code' => $faker->word,
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
    $event = create('App\Event');

    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'reservation_name' => function() use ($event) {
            return $event->name;
        },
        'reservation_fee' => function() use ($event) {
            return $event->fee;
        },        
        'reservation_id' => function() use ($event) {
            return $event->id;
        },
        'reservation_type' => function() use ($event) {
            return get_class($event);
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
    return [
        'user_id' => function() {
            return create('App\User')->id;
        },
        'plan_id' => function() {
            return create('App\Plan', ['name' => 'semanal'])->id;
        },
        'reference' => $faker->swiftBicNumber,
        'next_payment_at' => function() {
            return create('App\Plan', ['name' => 'semanal'])->renewsAt();
        }
    ];
});

$factory->define(App\Workshop::class, function(Faker $faker) {
    $date = now()->copy()->addDays(mt_rand(1,5));

    return [
        'slug' => str_slug($faker->sentence),
        'name' => $faker->sentence,
        'headline' => $faker->sentence,
        'description' => $faker->paragraph,
        'fee' => $faker->numberBetween(20,100),
        'cover_image' => $faker->imageUrl(),
        'capacity' => $faker->numberBetween(12,30),
        'starts_at' => $date,
        'ends_at' => $date->addHours(2)
    ];
});

$factory->define(App\WorkshopFile::class, function(Faker $faker) {
    return [
        'workshop_id' => function() {
            return factory('App\Workshop')->create()->id;
        },
        'path' => $faker->imageUrl(),
        'name' => $faker->word,
        'extension' => $faker->word
    ];
});
