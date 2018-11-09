<?php

namespace App;

class Event extends Metropolis
{
	protected $dates = ['starts_at', 'ends_at'];

	public function creator()
	{
		return $this->belongsTo(User::class);
	}

    public function space()
    {
    	return $this->belongsTo(Space::class);
    }

    public function getHasPassedAttribute()
    {
    	return $this->ends_at < now();
    }

    public function getIsCurrentAttribute()
    {
    	return $this->starts_at <= now() && $this->ends_at > now();
    }
}
