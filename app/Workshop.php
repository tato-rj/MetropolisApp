<?php

namespace App;

class Workshop extends Metropolis
{    
	protected $withCount = ['attendees'];

    public function attendees()
    {
    	return $this->belongsToMany(User::class, 'user_workshop', 'user_id', 'workshop_id');
    }

    public function isFull()
    {
    	return $this->attendees_count >= $this->capacity;
    }
}
