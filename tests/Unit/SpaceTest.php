<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{Event, Space};

class SpaceTest extends AppTest
{
	/** @test */
	public function it_has_many_events()
	{
		$this->conference->events()->save($this->event);
		$this->assertInstanceOf(Event::class, $this->conference->events()->first());
	}

	/** @test */
	public function it_knows_its_day_length()
	{
		$this->assertInternalType('int', $this->conference->day_length);
	}

	/** @test */
	public function it_knows_its_starting_and_ending_hours()
	{
		$this->assertTrue($this->conference->day_starts_at < $this->conference->day_ends_at);
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
		Event::truncate();

        $pastEvent = make(Event::class, [
            'starts_at' => now()->copy()->subHours(5),
            'ends_at' => now()->copy()->subHours(2),
        ]);

        $currentEvent = make(Event::class, [
            'starts_at' => now()->copy()->subHour(),
            'ends_at' => now()->copy()->addHour(),
        ]);
        
        $futureEvent = make(Event::class, [
            'starts_at' => now()->copy()->addHours(5),
            'ends_at' => now()->copy()->addHours(8),
        ]);

		$this->conference->events()->save($pastEvent);

		$this->conference->events()->save($futureEvent);

		$this->assertTrue($this->conference->checkAvailability(now(), $duration = 1)->status);

		$this->conference->events()->save($currentEvent);

		$this->assertFalse($this->conference->checkAvailability(now(), $duration = 1)->status);
	}

	/** @test */
	public function it_keeps_track_of_its_total_capacity()
	{
		$this->assertEquals($this->workspace->participantsLeftOn(now(), $duration = 1), 12);

		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 4,
			'starts_at' => now()->copy()->subMinutes(30),
			'ends_at' => now()->copy()->addHour()
		]);

		$this->assertEquals($this->workspace->participantsLeftOn(now(), $duration = 1), 8);
		
		$this->assertTrue($this->workspace->checkAvailability(now(), $duration = 1, $participants = 4)->status);

		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 3,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addMinutes(30)
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
	public function it_knows_how_to_ignore_memberships_when_checking_if_the_workstation_is_full()
	{
		create(Event::class, [
			'space_id' => $this->workspace->id,
			'plan_id' => $this->plan->id,
			'participants' => 1,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		create(Event::class, [
			'space_id' => $this->workspace->id,
			'participants' => 8,
			'starts_at' => now()->copy()->subHour(),
			'ends_at' => now()->copy()->addHour()
		]);

		$reportForAdmin = $this->workspace->checkAvailability(now(), $duration = 1, $participants = 8, $includePlan = true);
		$reportForUser = $this->workspace->checkAvailability(now(), $duration = 1, $participants = 8, $includePlan = false);

		$this->assertFalse($reportForAdmin->status);
		$this->assertEquals($reportForAdmin->participantsLeft, 3);

		$this->assertFalse($reportForUser->status);
		$this->assertEquals($reportForUser->participantsLeft, 4);
	}

	/** @test */
	public function it_knows_when_is_the_next_business_day()
	{
		$this->assertTrue(office()->nextBusinessDay()->isWeekDay());
	}
}
