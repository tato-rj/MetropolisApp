<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Workshop};

class WorkshopTest extends AppTest
{
	/** @test */
	public function it_has_many_attendees()
	{
		$this->signIn();

		$this->workshop->attendees()->save(auth()->user());

		$this->assertInstanceOf(User::class, $this->workshop->attendees()->first());
	}

	/** @test */
	public function it_knows_if_its_capacity_has_reached_its_limit()
	{
		$workshop = create(Workshop::class, ['capacity' => 1]);

		$this->assertFalse($workshop->isFull());

		$this->signIn();
		
		$workshop->attendees()->save(auth()->user());

		$this->assertTrue($workshop->fresh()->isFull());
	}
}
