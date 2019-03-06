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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getNameAttribute()
    {
    	return $this->workshop->name;
    }

    public function getFeeAttribute()
    {
    	return $this->workshop->fee;
    }

    public function getOwnerIdAttribute()
    {
        return $this->user_id;
    }

    public function setStatus($status_id)
    {
        $this->update([
            'status_id' => $status_id,
            'verified_at' => now()
        ]);

        return $this;
    }

    public function cancel()
    {
        event(new \App\Events\EventCanceled($this));
        
        return $this->setStatus(7);
    }
}
