<?php

namespace App;

use App\Traits\PagSeguro;
use App\Contracts\Reservation;

class Event extends Metropolis implements Reservation
{
    use PagSeguro;

	protected $dates = ['starts_at', 'ends_at', 'verified_at'];
    protected $appends = ['title', 'start', 'end', 'duration', 'status', 'statusForUser', 'statusColor'];

	public function creator()
	{
		return $this->morphTo();
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

    public function getOwnerIdAttribute()
    {
        return $this->creator_id;
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
        $plan = $this->plan()->exists() ? ' (' . $this->plan->displayName . ')' : null;

        return ucfirst($this->space->name) . $plan;
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
        if (! $this->plan()->exists()) {
            $duration = $this->starts_at->diffInHours($this->ends_at);
            return "$duration ". trans_choice('words.horas', $duration);
        }

        if ($this->plan->name == 'semanal')
            return '1 semana';

        if ($this->plan->name == 'mensal')
            return '1 mês';
        
        if ($this->plan->name == 'semestral')
            return '6 meses';
    }

    public function getNameAttribute()
    {
        if ($this->plan()->exists())
            return $this->plan->displayName;

        return $this->space->name;
    }

    public function getEditableAttribute()
    {
        return ! $this->plan()->exists();
    }

    public function getEmailsAttribute($emails)
    {
        return unserialize($emails);
    }

    public function scopeNow($query)
    {
        if (! office()->isOpen())
            return collect();

        return $query->whereDate('starts_at', '<=', now())->whereDate('ends_at', '>', now())->get();
    }

    public function scopeCalendar($query)
    {
        $eventsTypes = $query->orderBy('starts_at')->get()->groupBy('title');

        // $eventsCount = $events->count();

        $doesOverlap = false;

        $results = collect();

        $eventsTypes->each(function($events) use ($results) {
            
            $eventsCount = $events->count();

            for ($i = 0; $i < $events->count(); $i++) {
                if ($i+1 < $eventsCount && empty($events[$i]->doesOverlap))
                    $events[$i]->doesOverlap = $events[$i+1]->doesOverlap = $events[$i]->ends_at->gt($events[$i+1]->starts_at);

                $events[$i] = $events[$i]->only(['id', 'title', 'start', 'end', 'plan_id', 'notified_at', 'statusForUser', 'editable', 'doesOverlap']);

                $results->push($events[$i]);
            }
            
        });

        return $results;
    }
}
