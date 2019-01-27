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
}
