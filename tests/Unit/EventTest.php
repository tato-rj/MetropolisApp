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
	public function it_belongs_to_a_user()
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
	public function it_knows_if_its_payment_has_been_submitted()
	{
		$unpaidEvent = create(Event::class, ['status_id' => 99]);
		$paidEvent = create(Event::class);

		$this->assertCount(1, Event::unpaid()->get());
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

	/** @test */
	public function it_checks_and_marks_any_conflicts_upon_creation_on_a_non_shared_space()
	{
		Event::truncate();

		$nonSharedSpace = create(Space::class, ['is_shared' => false, 'capacity' => 5]);

		$event1 = create(Event::class, ['space_id' => $nonSharedSpace, 'participants' => 1]);
	
		$event2 = create(Event::class, ['space_id' => $nonSharedSpace, 'participants' => 1]);

		$this->assertFalse($event1->fresh()->has_conflict);
		$this->assertTrue($event2->fresh()->has_conflict);
	}

	/** @test */
	public function it_checks_and_marks_any_conflicts_upon_creation_on_a_shared_space()
	{
		Event::truncate();

		$sharedSpace = create(Space::class, ['is_shared' => true, 'capacity' => 5]);

		$event1 = create(Event::class, ['space_id' => $sharedSpace, 'participants' => 2]);
		$event2 = create(Event::class, ['space_id' => $sharedSpace, 'participants' => 2]);
		$event3 = create(Event::class, ['space_id' => $sharedSpace, 'participants' => 1]);
		$event4 = create(Event::class, ['space_id' => $sharedSpace, 'participants' => 1]);

		$this->assertFalse($event1->fresh()->has_conflict);
		$this->assertFalse($event2->fresh()->has_conflict);
		$this->assertFalse($event3->fresh()->has_conflict);
		$this->assertTrue($event4->fresh()->has_conflict);
	}
}
