<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Event, Plan, Membership, Bonus, Payment};

class UserTest extends AppTest
{
	/** @test */
	public function it_knows_its_first_name()
	{
		$user = create(User::class);

		$this->assertTrue(strpos($user->name, $user->first_name) !== false);
	}

	/** @test */
	public function it_has_many_events()
	{
		$this->signIn();

		auth()->user()->events()->save($this->currentEvent);
		
		$this->assertInstanceOf(Event::class, auth()->user()->events()->first()); 
	}

	/** @test */
	public function it_has_many_payments()
	{
		$this->signIn();

		auth()->user()->payments()->save($this->payment);
		
		$this->assertInstanceOf(Payment::class, auth()->user()->payments()->first());
	}

	/** @test */
	public function it_may_have_many_bonuses()
	{
		$this->signIn();
		
		$bonus = create(Bonus::class);

		auth()->user()->bonuses()->save($bonus);
		
		$this->assertInstanceOf(Bonus::class, auth()->user()->bonuses()->first()); 		 
	}

	/** @test */
	public function it_knows_how_to_subscribe_to_a_plan()
	{
		$this->signIn();

		auth()->user()->subscribe($this->plan, 'reference');

		$this->assertTrue(auth()->user()->membership()->exists());
		$this->assertInstanceOf(Plan::class, auth()->user()->membership->plan);
	}

	/** @test */
	public function it_knows_if_it_has_an_upcoming_event()
	{
		$this->signIn();

		$event = create(Event::class, [
			'starts_at' => now()->copy()->addDay(), 
			'ends_at' => now()->copy()->addDay()->addHour()
		]);
		
		auth()->user()->events()->save($event);

		$this->assertCount(1, auth()->user()->events);
		$this->assertCount(1, auth()->user()->upcomingEvents);
		$this->assertEmpty(auth()->user()->currentEvents);
		$this->assertCount(0, auth()->user()->pastEvents);
	}

	/** @test */
	public function it_knows_if_it_has_a_current_event()
	{
		$this->signIn();

		$event = create(Event::class, [
			'starts_at' => now()->copy()->subDay(), 
			'ends_at' => now()->copy()->addDay()
		]);

		auth()->user()->events()->save($event);
		
		$this->assertCount(1, auth()->user()->events);
		$this->assertCount(0, auth()->user()->upcomingEvents);
		$this->assertNotEmpty(auth()->user()->currentEvents);
		$this->assertCount(0, auth()->user()->upcomingEvents);
	}

	/** @test */
	public function it_knows_if_it_has_a_past_event()
	{
		$this->signIn();

		$event = create(Event::class, [
			'starts_at' => now()->copy()->subDay()->subHour(), 
			'ends_at' => now()->copy()->subDay()
		]);

		auth()->user()->events()->save($event);

		$this->assertCount(1, auth()->user()->events);
		$this->assertCount(0, auth()->user()->upcomingEvents);
		$this->assertEmpty(auth()->user()->currentEvents);
		$this->assertCount(1, auth()->user()->pastEvents);
	}

	/** @test */
	public function it_knows_how_many_bonuses_hours_it_has_left()
	{
		$this->signIn();

		$plan = create(Plan::class, [
			'bonus_spaces' => $this->space->id,
			'bonus_limit' => 3
		]);

		$this->assertNull(auth()->user()->bonusesLeft($this->space));

		$this->subscribeToNewPlan($plan);
		
		$this->assertEquals(auth()->user()->bonusesLeft($this->space), $plan->bonus_limit);

        $this->post(route('client.events.purchase'), [
            'creator_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);
        
        $this->assertEquals(auth()->user()->fresh()->bonusesLeft($this->space), 1);
	}

	/** @test */
	public function it_knows_how_to_use_a_bonus()
	{
		$this->signIn();

		$plan = create(Plan::class, ['bonus_limit' => 2, 'bonus_spaces' => $this->space]);

		$this->subscribeToNewPlan($plan);

		$this->createNewEvent();

		auth()->user()->useBonus(auth()->user()->events->last(), $duration = 1);

		$this->assertCount(1, auth()->user()->bonuses);
	}
}
