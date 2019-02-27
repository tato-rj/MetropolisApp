<?php

namespace Tests\Unit;

use Tests\AppTest;
use App\{User, Workshop, WorkshopFile, Payment};

class WorkshopTest extends AppTest
{
	/** @test */
	public function it_has_many_attendees()
	{
		$this->signIn();

		$this->workshop->attendees()->save(auth()->user());

		$this->assertInstanceOf(User::class, $this->workshop->attendees()->find(auth()->user()->id));
	}

	/** @test */
	public function it_has_a_payment()
	{
		$this->signIn();

		$reservation = auth()->user()->signup($this->workshop);

		$reservation->update(['reference' => 'ref', 'transaction_code' => 'code']);

		Payment::record($reservation);

		$this->assertInstanceOf(Payment::class, $reservation->payment); 
	}

	/** @test */
	public function it_has_many_files()
	{
		$file = create(WorkshopFile::class, ['workshop_id' => $this->workshop->id]);

		$this->assertInstanceOf(WorkshopFile::class, $this->workshop->files->first());
	}

	/** @test */
	public function it_knows_the_upcoming_events()
	{
		$pastWorkshop = create('App\Workshop', ['ends_at' => now()->copy()->subWeek()]);

		$this->assertCount(1, Workshop::upcoming()->get());
	}

	/** @test */
	public function it_knows_all_events_this_week()
	{
		Workshop::truncate();

		create(Workshop::class, ['ends_at' => now()->copy()->endOfWeek()->subDays(mt_rand(1,2))->setTime(20,0,0)]);
		create(Workshop::class, ['ends_at' => now()->copy()->addMonth()->subDays(mt_rand(1,2))->setTime(20,0,0)]);

		$this->assertCount(2, Workshop::all());
		$this->assertCount(1, Workshop::currentWeek()->get());
	}

	/** @test */
	public function it_knows_all_events_this_month()
	{
		Workshop::truncate();

		create(Workshop::class, ['ends_at' => now()->copy()->endOfMonth()->subDays(mt_rand(1,2))->setTime(20,0,0)]);
		create(Workshop::class, ['ends_at' => now()->copy()->addMonths(2)->subDays(mt_rand(1,2))->setTime(20,0,0)]);

		$this->assertCount(2, Workshop::all());
		$this->assertCount(1, Workshop::currentMonth()->get());
	}

	/** @test */
	public function it_knows_all_free_events()
	{
		Workshop::truncate();

		create(Workshop::class, ['fee' => null]);
		create(Workshop::class);

		$this->assertCount(2, Workshop::all());
		$this->assertCount(1, Workshop::free()->get());
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

	/** @test */
	public function its_description_is_automatically_sanitized()
	{
		$badRecord = make(Workshop::class, ['description' => '<script>alert("bad")</script><p>This is ok</p>']);

		$this->assertEquals($badRecord->description, '<p>This is ok</p>');
	}
}
