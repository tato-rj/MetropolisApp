<?php

namespace App;

class Membership extends Metropolis
{
    protected $dates = ['next_payment_at', 'subscription_ends_at', 'renewed_at','canceled_at'];

    public function plan()
    {
    	return $this->belongsTo(Plan::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function start()
    {
        return $this->user->events()->create([
            'plan_id' => $this->plan->id,
            'fee' => $this->plan->fee,
            'starts_at' => $this->created_at->setTime(office()->day_starts_at,0,0),
            'ends_at' => $this->next_payment_at
        ]);
    }
}
