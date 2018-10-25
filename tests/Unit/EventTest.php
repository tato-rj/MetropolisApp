<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Office\Space;
use App\{Event, User};

class EventTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_space()
	{
		$this->assertInstanceOf(Space::class, $this->event->space());
	}

	/** @test */
	public function it_belongs_to_a_creator()
	{
		$this->assertInstanceOf(User::class, $this->event->creator); 
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
