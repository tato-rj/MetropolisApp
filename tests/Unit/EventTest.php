<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{Event, Space, User, Bonus};

class EventTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_space()
	{
		$this->currentEvent->space()->associate($this->space);
		$this->assertInstanceOf(Space::class, $this->currentEvent->space);
	}

	/** @test */
	public function it_belongs_to_a_creator()
	{
		$this->assertInstanceOf(User::class, $this->currentEvent->creator); 
	}

	/** @test */
	public function it_may_have_a_bonus_applies_to_it()
	{
		create(Bonus::class, ['event_id' => $this->currentEvent]);
		$this->assertInstanceOf(Bonus::class, $this->currentEvent->bonus);
	}

	/** @test */
	public function it_knows_if_it_is_a_future_event()
	{
		$event = create(Event::class, [
			'starts_at' => now()->addDay(), 
			'ends_at' => now()->addDay()->addHour()
		]);

		$this->assertFalse($event->hasPassed);
		$this->assertFalse($event->isCurrent);
	}

	/** @test */
	public function it_knows_if_it_is_a_current_event()
	{
		$event = create(Event::class, [
			'starts_at' => now()->subHour(), 
			'ends_at' => now()->addHour()
		]);

		$this->assertFalse($event->hasPassed);
		$this->assertTrue($event->isCurrent);
	}

	/** @test */
	public function it_knows_if_it_is_a_past_event()
	{
		$event = create(Event::class, [
			'starts_at' => now()->subDay()->subHour(), 
			'ends_at' => now()->subDay()
		]);

		$this->assertTrue($event->hasPassed);
		$this->assertFalse($event->isCurrent);
	}
}
