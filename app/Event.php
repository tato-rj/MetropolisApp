<?php

namespace App;

use App\Traits\PagSeguro;
use App\Contracts\Reservation;

class Event extends Metropolis implements Reservation
{
    use PagSeguro;

	protected $dates = ['starts_at', 'ends_at', 'verified_at'];
    protected $appends = ['title', 'start', 'end', 'duration', 'status', 'statusForUser', 'statusColor'];
    protected $casts = ['has_conflict' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        self::creating(function($event) {
            $event->markConflict();
        });
    }

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

    public function cancel()
    {
        return $this->setStatus(7);
    }

    public function getOwnerIdAttribute()
    {
        return $this->creator_id;
    }

    public function getHasConflictAttribute($value)
    {
        return $this->statusForUser == 'Cancelada' ? false : (bool)$value;
    }

    public function getHasPassedAttribute()
    {
    	return $this->ends_at < now()->today();
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
        $array = $query->get()->map(function($item, $index) {
            return $item->only(['id', 'title', 'start', 'end', 'plan_id', 'notified_at', 'statusForUser', 'editable', 'has_conflict', 'participants']);
        });

        return $array;
    }

    public function markConflict()
    {
        $results = $this->space->checkAvailability(
            $this->starts_at, 
            $this->starts_at->diffInHours($this->ends_at), 
            $this->participants, 
            $includePlan = true);

        $this->has_conflict = ! $results->status;
    }

    public function scopeToday($query)
    {
        $office = office();

        return $query->where('ends_at', '>', now()->setTime($office->day_starts_at,0,0))->where('starts_at', '<', now()->setTime($office->day_ends_at,0,0));
    }

    public function scopeWithConflict($query)
    {
        return $query->where('has_conflict', true);
    }
}
