<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\{Admin, Event};
use Tests\Traits\FakeEvents;

class EventTest extends AppTest
{
	use FakeEvents;
	
    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

	/** @test */
	public function it_can_create_an_event()
	{
    	$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent()->assertSessionHas('status');

		$this->assertCount(1, $this->admin->events);
	}
}
