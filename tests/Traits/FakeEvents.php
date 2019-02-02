<?php

namespace Tests\Traits;

trait FakeEvents
{
    
    protected function signIn($user = null)
    {
    	$user = ($user) ?: create('App\User');
    	return $this->actingAs($user);
    }

    public function createNewEvent($user = null)
    {
        $user = $user ?? auth()->user();

        return $this->post(route('client.events.purchase'), [
            'space_id' => $this->space->id,
            'participants' => 1,
            'guests' => null,
            'date' => now(),
            'time' => now()->hour,
            'duration' => 2
        ]);
    }

    public function signUpToNewWorkshop($workshop, $user = null)
    {
        $user = $user ?? auth()->user();

        return $this->post(route('workshops.purchase', $workshop->slug));
    }

    public function subscribeToNewPlan($plan, $user = null)
    {
        $user = $user ?? auth()->user();

        return $this->post(route('plan.subscribe'), [
            'plan_id' => $plan->id
        ]);
    }
}