<?php

namespace App;

use App\Office\Conference;

class Event extends Metropolis
{
	protected $dates = ['starts_at', 'ends_at'];

	public function creator()
	{
		return $this->belongsTo(User::class);
	}

    public function space()
    {
    	return new $this->type;
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
