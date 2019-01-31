<?php

namespace App;

use App\Traits\FindBySlug;

class Workshop extends Metropolis
{
	use FindBySlug;
	
    protected $dates = ['starts_at', 'ends_at'];
	protected $withCount = ['attendees'];

    public function attendees()
    {
    	return $this->belongsToMany(User::class, 'user_workshops', 'workshop_id', 'user_id');
    }

    public function isFull()
    {
    	return $this->attendees_count >= $this->capacity;
    }

    public function getReservationAttribute()
    {
        return $this->pivot;
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('ends_at', '>=', now())->orderBy('starts_at');
    }
}
