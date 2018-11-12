<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Event, User};

class EventTest extends AppTest
{
	/** @test */
	public function authenticated_users_can_create_an_event()
	{
		$this->signIn();

		$this->assertFalse(auth()->user()->events()->exists());

		$this->postNewEvent()->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->events()->exists());
	}

	/** @test */
	public function unauthenticated_users_cannot_create_an_event()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$unauthenticatedUser = create(User::class);
		
		$this->postNewEvent($unauthenticatedUser);
	}
}
