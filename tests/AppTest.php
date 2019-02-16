<?php

namespace Tests;

use Tests\Utilities\ExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\{Space, Event, Plan, Payment, Workshop, User};
use Tests\Traits\FakeEvents;

abstract class AppTest extends TestCase
{
	use DatabaseMigrations, ExceptionHandling, FakeEvents;

    public function setUp()
    {
        parent::setUp();

        $this->disableExceptionHandling();

        $this->workspace = create(Space::class, ['is_shared' => true, 'capacity' => 12]);

        $this->conference = create(Space::class, ['is_shared' => false]);

        $this->workshop = create(Workshop::class);

        $this->event = create(Event::class);

        $this->plan = create(Plan::class);

        $this->payment = create(Payment::class);

        $this->user = create(User::class);
    }

    protected function signIn($user = null, $guard = null)
    {
        $user = $user ?? create('App\User');

        return $this->actingAs($user, $guard);
    }
}