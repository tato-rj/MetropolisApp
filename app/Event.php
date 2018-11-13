<?php

namespace App;

class Event extends Metropolis
{
	protected $dates = ['starts_at', 'ends_at'];
    protected $appends = ['title', 'start', 'end', 'duration'];

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

    public function getTitleAttribute()
    {
        return ucfirst($this->space->name);
    }

    public function getStartAttribute()
    {
        return $this->starts_at->toDateTimeString();
    }

    public function getEndAttribute()
    {
        return $this->ends_at->toDateTimeString();
    }

    public function getDurationAttribute()
    {
        return $this->ends_at->hour - $this->starts_at->hour;
    }

    public function getEmailsAttribute($emails)
    {
        return unserialize($emails);
    }
}
