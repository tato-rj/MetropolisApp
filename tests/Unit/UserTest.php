<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Event};

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

		$event = create(Event::class);

		auth()->user()->events()->save($event);

		$this->assertInstanceOf(Event::class, auth()->user()->events()->first()); 
	}
}
