<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{Event, Admin};

class AdminTest extends AppTest
{
    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

	/** @test */
	public function it_has_many_events()
	{
		create(Event::class, ['creator_id' => $this->admin->id, 'creator_type' => get_class($this->admin)]);

		$this->assertInstanceOf(Event::class, $this->admin->events()->first());
	}

    /** @test */
    public function it_knows_if_it_is_a_manager()
    {
    	$this->assertTrue($this->admin->isManager());

    	$this->assertFalse(create(Admin::class, ['role' => 'staff'])->isManager());
    }
}
