<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{Event, Space};

class SpaceTest extends AppTest
{
	/** @test */
	public function it_has_many_events()
	{
		$this->space->events()->save($this->currentEvent);
		$this->assertInstanceOf(Event::class, $this->space->events()->first());
	}

	/** @test */
	public function it_knows_its_day_length()
	{
		$this->assertInternalType('int', $this->space->day_length);
	}

	/** @test */
	public function it_knows_its_starting_and_ending_hours()
	{
		$this->assertTrue($this->space->day_starts_at < $this->space->day_ends_at);
	}

	/** @test */
	public function it_can_calcultate_the_cost_of_a_reservation()
	{
		$workstation = create(Space::class, ['is_shared' => true]);
		$conference = create(Space::class, ['is_shared' => false]);
		$duration = 2;

		$this->assertTrue($workstation->priceFor(4, $duration) > $workstation->fee/100);
		$this->assertTrue($conference->priceFor(4, $duration) > $conference->fee/100);
	}

	/** @test */
	public function it_knows_if_it_is_available_on_any_given_time()
	{
		$this->space->events()->save($this->pastEvent);

		$this->space->events()->save($this->futureEvent);

		$this->assertTrue($this->space->checkAvailability(now(), $duration = 1)->status);

		$this->space->events()->save($this->currentEvent);

		$this->assertFalse($this->space->checkAvailability(now(), $duration = 1)->status);
	}

	/** @test */
	public function it_keeps_track_of_its_total_capacity()
	{
		$this->assertEquals($this->workspace->participantsLeftOn(now(), $duration = 1), 12);

		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 4,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		$this->assertEquals($this->workspace->participantsLeftOn(now(), $duration = 1), 8);
		
		$this->assertTrue($this->workspace->checkAvailability(now(), $duration = 1, $participants = 4)->status);

		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 3,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		$this->assertEquals($this->workspace->participantsLeftOn(now(), $duration = 1), 5);

		$this->assertFalse($this->workspace->checkAvailability(now(), $duration = 1, $participants = 8)->status);
	}

	/** @test */
	public function if_it_reaches_its_limit_it_knows_how_many_participants_it_can_still_accept()
	{
		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 8,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		$report = $this->workspace->checkAvailability(now(), $duration = 1, $participants = 8);

		$this->assertFalse($report->status);
		$this->assertEquals($report->participantsLeft, 4);
	}

	/** @test */
	public function it_ignores_memberships_when_checking_if_the_workstation_is_full()
	{
		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 8,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		$report = $this->workspace->checkAvailability(now(), $duration = 1, $participants = 8);

		$this->assertFalse($report->status);
		$this->assertEquals($report->participantsLeft, 4);
	}

	/** @test */
	public function it_knows_when_is_the_next_business_day()
	{
		$this->assertTrue(office()->nextBusinessDay()->isWeekDay());
	}
}
