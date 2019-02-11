<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Event, User, Newsletter};
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
	public function a_user_can_save_its_card_information_when_making_a_purchase()
	{
		$this->signIn();

		$this->assertFalse(auth()->user()->fresh()->hasCard);

		$this->createNewEvent($user = null, $saveCard = true)->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->hasCard);
	}

	/** @test */
	public function a_users_payment_information_is_not_saved_if_the_checkbox_has_not_been_checked()
	{
		$this->signIn();

		$this->createNewEvent($user = null, $saveCard = false)->assertSessionHas('status');

		$this->assertFalse(auth()->user()->fresh()->hasCard);
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

		$data = array_merge([
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour . '.0',
            'duration' => 2
        ], $this->cardFields);

        $this->post(route('client.events.purchase'), $data);

		Mail::assertQueued(InviteToEvent::class, 2);		 
	}

	/** @test */
	public function the_creator_can_resend_all_invitation_emails()
	{
		$this->signIn();

		$data = array_merge([
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour . '.0',
            'duration' => 2
        ], $this->cardFields);

        $this->post(route('client.events.purchase'), $data);

		Mail::fake();

		$this->post(route('client.events.invite'), ['event_id' => auth()->user()->events->first()->id]);

		Mail::assertQueued(InviteToEvent::class, 2);		 
	}

	/** @test */
	public function all_guests_emails_given_are_saved_on_the_newsletter_table()
	{
		$this->signIn();

		$data = array_merge([
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest2@email.com'],
            'date' => now(),
            'time' => now()->hour . '.0',
            'duration' => 2
        ], $this->cardFields);

		$this->post(route('client.events.purchase'), $data);

		$this->assertDatabaseHas('newsletters', ['email' => 'guest1@email.com']);
	}

	/** @test */
	public function no_email_is_added_twice_in_the_newsletter_table()
	{
		$this->signIn();

		$data = array_merge([
            'user_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 3,
            'emails' => ['guest1@email.com', 'guest1@email.com'],
            'date' => now(),
            'time' => now()->hour . '.0',
            'duration' => 2
        ], $this->cardFields);

		$this->post(route('client.events.purchase'), $data);

		$this->assertCount(1, Newsletter::all());
	}
}
