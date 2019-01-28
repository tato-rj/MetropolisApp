<?php

namespace Tests;

use Tests\Utilities\ExceptionHandling;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\{Space, Event, Plan, Payment};

abstract class AppTest extends TestCase
{
	use DatabaseMigrations, ExceptionHandling;

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

        $this->plan = create(Plan::class);

        $this->payment = create(Payment::class);
    }
    
    protected function signIn($user = null)
    {
    	$user = ($user) ?: create('App\User');
    	return $this->actingAs($user);
    }

    public function createNewEvent($user = null)
    {
        $user = $user ?? auth()->user();

        return $this->post(route('client.events.purchase'), [
            'creator_id' => $user->id,
            'space_id' => $this->space->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);
    }

    public function subscribeToNewPlan($plan, $user = null)
    {
        $user = $user ?? auth()->user();

        return $this->post(route('client.plan.subscribe'), [
            'user_id' => $user->id,
            'plan_id' => $plan->id
        ]);
    }
}