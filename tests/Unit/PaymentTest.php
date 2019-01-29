<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Contracts\Product;
use App\{User, Payment, Event};

class PaymentTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_user()
	{
		$this->assertInstanceOf(User::class, $this->payment->user);
	}

	/** @test */
	public function it_has_a_product()
	{
		$this->assertInstanceOf(Product::class, $this->payment->product);
	}

	/** @test */
	public function it_knows_how_to_record_an_event()
	{
		$event = create(Event::class);
		
		Payment::record($event);

		$this->assertDatabaseHas('payments', [
			'product_id' => $event->id,
			'product_type' => get_class($event)
		]);
	}
}
