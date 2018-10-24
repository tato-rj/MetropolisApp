<?php

namespace App;

use App\Office\Conference;

class Event extends Metropolis
{
	public function creator()
	{
		return $this->belongsTo(User::class);
	}

    public function space()
    {
    	return new $this->type;
    }
}
