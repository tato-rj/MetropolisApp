<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Contracts\Reservation;
use App\{User, Payment, Event};

class PaymentTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_user()
	{
		$this->assertInstanceOf(User::class, $this->payment->user);
	}

	/** @test */
	public function it_has_a_reservation()
	{
		$this->assertInstanceOf(Reservation::class, $this->payment->reservation);
	}

	/** @test */
	public function it_knows_how_to_record_an_event()
	{
		$event = create(Event::class);
		
		Payment::record($event);

		$this->assertDatabaseHas('payments', [
			'reservation_id' => $event->id,
			'reservation_type' => get_class($event)
		]);
	}
}
