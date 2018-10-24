<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Office\Space;
use App\{Event, User};

class EventTest extends AppTest
{
	/** @test */
	public function it_belongs_to_a_space()
	{
		$this->assertInstanceOf(Space::class, $this->event->space());
	}

	/** @test */
	public function it_belongs_to_a_creator()
	{
		$this->assertInstanceOf(User::class, $this->event->creator); 
	}
}
