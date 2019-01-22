<?php

namespace App;

use App\Traits\PagSeguro;

class Event extends Metropolis
{
    use PagSeguro;

	protected $dates = ['starts_at', 'ends_at', 'notified_at'];
    protected $appends = ['title', 'start', 'end', 'duration', 'status', 'statusForUser'];

	public function creator()
	{
		return $this->belongsTo(User::class);
	}

    public function space()
    {
    	return $this->belongsTo(Space::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function bonus()
    {
        return $this->hasOne(Bonus::class);
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
        if ($this->starts_at->isSameDay($this->ends_at)) {
            $duration = $this->starts_at->diffInHours($this->ends_at);
            return "$duration ". trans_choice('words.horas', $duration);
        }
        
        $duration = $this->starts_at->diffInDays($this->ends_at);
        return "$duration ". trans_choice('words.dias', $duration);
    }

    public function getEmailsAttribute($emails)
    {
        return unserialize($emails);
    }
}
