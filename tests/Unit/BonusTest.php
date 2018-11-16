<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{Bonus, User, Space, Plan, Event};

class BonusTest extends AppTest
{
	protected $bonus;

    public function setUp()
    {
        parent::setUp();
        $this->bonus = create(Bonus::class);
    }

	/** @test */
	public function it_belongs_to_a_user()
	{
		$this->assertInstanceOf(User::class, $this->bonus->user);
	}

	/** @test */
	public function it_belongs_to_an_event()
	{
		$this->assertInstanceOf(Event::class, $this->bonus->event);
	}

	/** @test */
	public function it_belongs_to_a_plan()
	{
		$this->assertInstanceOf(Plan::class, $this->bonus->plan);		 
	}

	/** @test */
	public function it_knows_its_limit()
	{
		$this->assertEquals($this->bonus->limit, $this->bonus->plan->bonus_limit);
	}

	/** @test */
	public function it_knows_how_to_ignore_bonuses_used_before_a_valid_membership_period()
	{
		$this->signIn();

		$plan = create(Plan::class, ['bonus_spaces' => $this->space->id, 'bonus_limit' => 3]);
		
		$this->subscribeToNewPlan($this->plan);

        $this->post(route('client.events.store'), [
            'creator_id' => auth()->user()->id,
            'space_id' => $this->space->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 1
        ]);

		$this->assertCount(1, Bonus::valid(auth()->user()->membership)->get());

		create(Bonus::class, ['user_id' => auth()->user()->id, 'plan_id' => $plan->id, 'created_at' => now()->copy()->subMonth()]);

		$this->assertCount(1, Bonus::valid(auth()->user()->membership)->get());
	}
}
