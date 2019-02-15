<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\{Admin, Event, Space};
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
	public function an_admin_can_create_an_event()
	{
    	$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent()->assertSessionHas('status');

		$this->assertCount(1, $this->admin->events);
	}

	/** @test */
	public function an_admin_can_update_the_events_start_and_end_date()
	{
    	$this->signIn($this->admin, 'admin');

    	$space = create(Space::class);
		
		$this->adminCreateNewEvent($space);

		$event = $space->events->first();

		$this->post(route('admin.schedule.update.datetime'), [
			'event_id' => $event->id,
			'starts_at' => '2019-03-05T08:00:00',
			'ends_at' => '2019-03-05T09:00:00'
		]);

		$this->assertEquals(carbon('2019-03-05T08:00:00'), $event->fresh()->starts_at);
	}

	/** @test */
	public function an_admin_can_update_the_conflict_status_of_an_event()
	{
    	$this->signIn($this->admin, 'admin');

		$sharedSpace = create(Space::class, ['is_shared' => true, 'capacity' => 3]);

		create(Event::class, ['space_id' => $sharedSpace, 'participants' => 2]);
		$event = create(Event::class, ['space_id' => $sharedSpace, 'participants' => 2]);

		$this->assertTrue($event->has_conflict);

		$this->post(route('admin.schedule.update.conflict', $event->id));

		$this->assertFalse($event->fresh()->has_conflict);
	}
}
