<?php

use Illuminate\Database\Seeder;
use App\{User, Event, Plan, Payment, Space, Workshop};

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
        	'name' => 'Arthur Villar',
            'email' => 'arthurvillar@gmail.com',
            'phone' => '(21) 9123-4567',
        	'email_verified_at' => now(),
        	'password' => bcrypt('maiden')
        ]);

        factory(User::class, mt_rand(15,35))->create()->each(function ($user) {
        	$this->createEvents($user, $chance = 8);
        	$this->createPlans($user, $chance = 2);
            $this->signupForWorkshops($user, $chance = 7);
        });

        $this->randomizeEventsStatus();
    }

    public function createEvents($user, $chance)
    {
    	$rand = mt_rand(1,10);
    	if ($rand < $chance) {
    		for ($i = 0; $i < $rand; $i++) {
	        	$starts_at = now()->copy()->setTime(mt_rand(8,16),0,0)->addDays(mt_rand(-3,20));

	        	if ($starts_at->isWeekend())
                    $starts_at->addDays(2);

	        	$event = factory(Event::class)->create([
	        		'creator_id' => $user->id,
	        		'creator_type' => get_class($user),
	        		'space_id' => Space::inRandomOrder()->first()->id,
	        		'starts_at' => $starts_at,
	        		'ends_at' => $starts_at->copy()->addHours(mt_rand(1,4))
	        	]);

	        	Payment::record($event);
    		}
        }
    }

    public function createPlans($user, $chance)
    {
    	if (mt_rand(1,10) < $chance) {
    		$plan = Plan::inRandomOrder()->first();
            $reference = randomNumber(12);

    		$user->subscribe($plan, $reference);

            Event::byReference($reference)->first()->update(['transaction_code' => randomNumber(12)]);
        }
    }

    public function signupForWorkshops($user, $chance)
    {
        if (mt_rand(1,10) < $chance) {
            $workshop = Workshop::inRandomOrder()->first();

            $reservation = $user->signup($workshop, randomNumber(12));

            $reservation->transaction_code = randomNumber(20);
            
            Payment::record($reservation);
        }
    }

    public function randomizeEventsStatus()
    {
    	$status = [0,1,2,3,3,3,3,3,3,3,3,4,5,6,7,8,9];

        Event::all()->each(function($event) use ($status) {
    		$event->update(['status_id' => $status[array_rand($status)]]);
        });
    }
}