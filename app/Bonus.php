<?php

namespace App;

class Bonus extends Metropolis
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function event()
    {
    	return $this->belongsTo(Event::class);
    }

    public function plan()
    {
    	return $this->belongsTo(Plan::class);
    }

    public function scopeValid($query, $membership)
    {
        if (! $membership)
            return $query;

        return $query->where('created_at', '>=', $membership->renewed_at);
    }

    public function getLimitAttribute()
    {
    	return $this->plan->bonus_limit;
    }
}
