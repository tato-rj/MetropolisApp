<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Event, User};
use App\Mail\{ConfirmEvent, InviteToEvent};
use Illuminate\Support\Facades\Mail;
use App\Events\EventCreated;

class EventTest extends AppTest
{
	/** @test */
	public function authenticated_users_can_create_an_event()
	{
		$this->expectsEvents(EventCreated::class);

		$this->signIn();

		$this->assertFalse(auth()->user()->events()->exists());

		$this->createNewEvent()->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->events()->exists());
	}

	/** @test */
	public function unauthenticated_users_cannot_create_an_event()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$unauthenticatedUser = create(User::class);
		
		$this->createNewEvent($unauthenticatedUser);
	}

	/** @test */
	public function the_creator_of_an_event_always_receives_a_confirmation_email()
	{
		Mail::fake();

		$this->signIn();

		$this->createNewEvent();

		Mail::assertQueued(ConfirmEvent::class);
	}

	/** @test */
	public function each_participant_can_receive_an_invitation_by_email()
	{
		Mail::fake();

		$this->signIn();

        $this->post(route('client.events.purchase'), [
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);

		Mail::assertQueued(InviteToEvent::class, 2);		 
	}

	/** @test */
	public function the_creator_can_resend_all_invitation_emails()
	{
		$this->signIn();

        $this->post(route('client.events.purchase'), [
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);

		Mail::fake();

		$this->post(route('client.events.invite'), ['event_id' => auth()->user()->events->first()->id]);

		Mail::assertQueued(InviteToEvent::class, 2);		 
	}
}
