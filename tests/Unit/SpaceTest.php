<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\Office\{Conference, CoWorking};
use App\Event;

class SpaceTest extends AppTest
{
	public function setUp()
	{
        parent::setUp();
		$this->space = new Conference;
		$this->event = create('App\Event', ['type' => get_class($this->space)]);
	}
	/** @test */
	public function it_has_many_events()
	{
		$this->assertInstanceOf(Event::class, $this->space->events()->first());
	}

	/** @test */
	public function it_knows_its_day_length()
	{
		$this->assertInternalType('int', $this->space->office->day_length);
	}

	/** @test */
	public function it_knows_its_starting_and_ending_hours()
	{
		$this->assertTrue($this->space->office->day_starts_at < $this->space->office->day_ends_at);
	}

	/** @test */
	public function it_knows_its_fees()
	{
		$this->assertTrue(count($this->space->fees()) > 1);
	}

	/** @test */
	public function it_knows_its_total_capacity()
	{
		$this->assertInternalType('int', $this->space->capacity());
	}
}
