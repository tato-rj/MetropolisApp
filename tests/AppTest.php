<?php

namespace Tests;

use Tests\Utilities\ExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\{Space, Event, Plan, Payment, Workshop};
use Tests\Traits\FakeEvents;

abstract class AppTest extends TestCase
{
	use DatabaseMigrations, ExceptionHandling, FakeEvents;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->workspace = create(Space::class, ['is_shared' => true, 'capacity' => 12]);
        $this->space = create(Space::class, ['is_shared' => false]);

        $this->pastEvent = create(Event::class, [
            'space_id' => 100,
            'starts_at' => now()->copy()->subHours(5),
            'ends_at' => now()->copy()->subHours(2),
        ]);

        $this->currentEvent = create(Event::class, [
            'space_id' => 100,
            'starts_at' => now()->copy()->subHour(),
            'ends_at' => now()->copy()->addHour(),
        ]);
        
        $this->futureEvent = create(Event::class, [
            'space_id' => 100,
            'starts_at' => now()->copy()->addHours(5),
            'ends_at' => now()->copy()->addHours(8),
        ]);

        $this->workshop = create(Workshop::class);

        $this->plan = create(Plan::class);

        $this->payment = create(Payment::class);
    }

    protected function signIn($user = null, $guard = null)
    {
        $user = ($user) ?: create('App\User');
        return $this->actingAs($user, $guard);
    }
}