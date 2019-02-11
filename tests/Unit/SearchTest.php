<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Event;

class SearchTest extends AppTest
{
	/** @test */
	public function it_knows_how_many_users_are_in_the_workstation_at_a_given_time()
	{
		$this->assertEquals(12, $this->workspace->participantsLeftOn(now(), $duration = 1));

		create(Event::class, ['space_id' => $this->workspace->id]);

		$this->assertEquals(11, $this->workspace->participantsLeftOn(now(), $duration = 1));
	}

	/** @test */
	public function it_ignores_plans_when_counting_the_number_of_participants()
	{
		$this->signIn();

		$this->assertEquals(12, $this->workspace->participantsLeftOn(now(), $duration = 1));
		
		$this->subscribeToNewPlan($this->plan);

		$this->assertEquals(12, $this->workspace->participantsLeftOn(now()->setTime(8,0,0), $duration = 1));
	}

	/** @test */
	public function an_event_cannot_be_booked_if_the_room_is_full()
	{
		$this->signIn();

		$this->space = $this->workspace;

		create(Event::class, ['space_id' => $this->space->id], 12);

		$eventsCount = $this->space->events->count();

        $this->createNewEvent();

        $this->assertEquals($eventsCount, $this->space->fresh()->events->count());
	}
}
