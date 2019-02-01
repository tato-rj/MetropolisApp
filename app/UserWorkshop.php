<?php

namespace App;

use App\Contracts\Reservation;
use App\Traits\PagSeguro;

class UserWorkshop extends Metropolis implements Reservation
{
    use PagSeguro;

    protected $dates = ['starts_at', 'ends_at', 'verified_at'];
    
    public function workshop()
    {
    	return $this->belongsTo(Workshop::class);
    }

    public function getNameAttribute()
    {
    	return $this->workshop->name;
    }

    public function getFeeAttribute()
    {
    	return $this->workshop->fee;
    }
}
