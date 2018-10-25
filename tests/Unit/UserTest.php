<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Event, Plan, Membership};

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

		auth()->user()->events()->save($this->event);
		
		$this->assertInstanceOf(Event::class, auth()->user()->events()->first()); 
	}

	/** @test */
	public function it_knows_how_to_subscribe()
	{
		$this->signIn();

		auth()->user()->subscribe($this->plan);

		$this->assertTrue(auth()->user()->membership()->exists());
	}

	/** @test */
	public function it_has_a_plan()
	{
		$this->signIn();

		auth()->user()->subscribe($this->plan);

		$this->assertInstanceOf(Plan::class, auth()->user()->membership->plan);
	}

	/** @test */
	public function it_knows_the_status_of_an_upcoming_event()
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
	public function it_knows_the_status_of_a_current_event()
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
	public function it_knows_the_status_of_a_past_event()
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
}
