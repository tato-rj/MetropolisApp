<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\{Space, Plan};

class BonusTest extends AppTest
{
	/** @test */
	public function it_automatically_applies_to_users_with_a_plan()
	{
		$this->signIn();

        $plan = create(Plan::class, ['bonus_spaces' => $this->space->id]);

		$this->subscribeToNewPlan($plan);

        $this->post(route('client.events.store'), [
            'creator_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 1
        ]);
        
        $this->assertDatabaseHas('bonuses', [
        	'user_id' => auth()->user()->id,
        	'event_id' => auth()->user()->events->last()->id,
        	'plan_id' => $plan->id
        ]);
	}
}
