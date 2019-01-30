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
		$this->expectException('Illuminate\Auth\Access\AuthorizationException');

		$this->signIn();

		create(Event::class, ['space_id' => $this->workspace->id], 12);

        $this->post(route('client.events.purchase'), [
            'user_id' => auth()->user()->id,
            'space_id' => $this->workspace->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);
	}
}
