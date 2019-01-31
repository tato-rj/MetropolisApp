<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\Events\WorkshopSignup;
use App\User;

class WorkshopTest extends AppTest
{
	/** @test */
	public function authenticated_users_can_signup_for_a_workshop()
	{
		$this->expectsEvents(WorkshopSignup::class);

		$this->signIn();

		$this->assertFalse(auth()->user()->workshops()->exists());

		$this->signUpToNewWorkshop($this->workshop)->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->workshops()->exists());

		$this->assertNotNull(auth()->user()->workshops()->first()->reservation->reference);
	}

	/** @test */
	public function unauthenticated_users_cannot_signup_for_a_workshop()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$unauthenticatedUser = create(User::class);
		
		$this->signUpToNewWorkshop($this->workshop, $unauthenticatedUser);
	}
}
