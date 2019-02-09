<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Plan, User};
use App\Events\MembershipCreated;
use App\Mail\ConfirmMembership;
use Illuminate\Support\Facades\Mail;

class PlanTest extends AppTest
{
	/** @test */
	public function authenticated_users_can_subscribe_to_a_plan()
	{
		$this->expectsEvents(MembershipCreated::class);

		$this->signIn();

		$this->assertFalse(auth()->user()->membership()->exists());

		$this->subscribeToNewPlan($this->plan)->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->membership()->exists());
	}

	/** @test */
	public function unauthenticated_users_cannot_subscribe()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$unauthenticatedUser = create(User::class);
		
		$this->subscribeToNewPlan($this->plan, $unauthenticatedUser);
	}

	/** @test */
	public function a_user_receives_an_email_when_subscribing_to_a_plan()
	{
		Mail::fake();

		$this->signIn();

		$this->subscribeToNewPlan($this->plan);

		Mail::assertQueued(ConfirmMembership::class);		 
	}

	/** @test */
	public function a_user_cannot_have_two_subscriptions()
	{
		$this->expectException('Illuminate\Auth\Access\AuthorizationException');
		
		$this->signIn();

		$this->assertFalse(auth()->user()->membership()->exists());

		$this->subscribeToNewPlan($this->plan);

		$this->subscribeToNewPlan($this->plan);
	}

	/** @test */
	public function an_event_is_automatically_created_upon_subscription()
	{
		$this->signIn();

		$this->assertEmpty(auth()->user()->eventsArray());

		$this->subscribeToNewPlan($this->plan);

		$this->assertCount(1, auth()->user()->fresh()->eventsArray());
	}
}
