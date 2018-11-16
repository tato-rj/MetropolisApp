<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Membership};

class PlanTest extends AppTest
{
	/** @test */
	public function it_has_many_memberships()
	{
		$this->signIn();

		auth()->user()->subscribe($this->plan);

		$this->assertInstanceOf(Membership::class, $this->plan->memberships->first());
	}

	/** @test */
	public function it_decreases_the_capacity_for_the_workstation()
	{
		$this->signIn();
		
		$this->assertEquals($this->workspace->currentCapacity, 12);

		auth()->user()->subscribe($this->plan);

		$this->assertEquals($this->workspace->currentCapacity, 11);
	}

	/** @test */
	public function it_knows_which_spaces_it_has_for_bonus()
	{
		$this->assertCount(1, $this->plan->bonusSpacesArray());
	}
}
