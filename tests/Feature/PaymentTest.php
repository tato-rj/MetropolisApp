<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Payment, Event};
use App\Events\EventCanceled;

class PaymentTest extends AppTest
{
	/** @test */
	public function users_can_only_see_details_of_their_own_payments()
	{
		$this->signIn();

		auth()->user()->events()->save($this->event);

		$knownPayment = Payment::record($this->event);

		$unknownPayment = Payment::record(create(Event::class));

		$this->get(route('status.payment', $knownPayment->transaction_code))->assertSee($knownPayment->reservation->statusForUser);

		$this->expectException('Illuminate\Auth\Access\AuthorizationException');

		$this->get(route('status.payment', $unknownPayment->transaction_code))->assertSee($unknownPayment->reservation->statusForUser);
	}
}
