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
}
