<?php

namespace App;

use App\Traits\PagSeguro;
use App\Contracts\Product;

class Event extends Metropolis implements Product
{
    use PagSeguro;

	protected $dates = ['starts_at', 'ends_at', 'verified_at'];
    protected $appends = ['title', 'start', 'end', 'duration', 'status', 'statusForUser', 'statusColor'];

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

    public function getEmailsAttribute($emails)
    {
        return unserialize($emails);
    }

    public function scopeByReference($query, $reference)
    {
        return $query->where('reference', $reference);
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('transaction_code', $code);
    }
}
