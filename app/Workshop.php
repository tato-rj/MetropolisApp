<?php

namespace App;

use App\Traits\FindBySlug;

class Workshop extends Metropolis
{
	use FindBySlug;
	
    protected $dates = ['starts_at', 'ends_at'];
	protected $withCount = ['attendees'];

    public function attendees()
    {
    	return $this->belongsToMany(User::class, 'user_workshops', 'workshop_id', 'user_id')->withTimestamps();
    }

    public function files()
    {
        return $this->hasMany(WorkshopFile::class);
    }

    public function isFull()
    {
    	return $this->attendees_count >= $this->capacity;
    }

    public function getReservationAttribute()
    {
        return UserWorkshop::where(['workshop_id' => $this->id, 'user_id' => $this->pivot->user_id])->first();
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('ends_at', '>', now());
    }

    public function scopeCurrentWeek($query)
    {
        return $query->whereDate('ends_at', '<', now()->endOfWeek());
    }

    public function scopeCurrentMonth($query)
    {
        return $query->whereDate('ends_at', '<', now()->endOfMonth());
    }

    public function scopeFree($query)
    {
        return $query->whereNull('fee');
    }

    public function hasPassed()
    {
        return now()->gt($this->ends_at);
    }

    public function getIsFreeAttribute()
    {
        return is_null($this->fee);
    }

    public function scopeFiltered($query)
    {
        $filtro = request('filtro');

        if ($filtro == 'todos')
            return $query;

        if ($filtro == 'semana')
            return $query->currentWeek();

        if ($filtro == 'mes')
            return $query->currentMonth();

        if ($filtro == 'gratuitos')
            return $query->free();

        return $query;
    }

    public function scopeOrdered($query)
    {
        $inputs = ['data_decresc', 'data_cresc', 'nome_decresc', 'nome_cresc'];

        if (in_array(request('ordem'), $inputs))
            return $this->setOrder($query, request('ordem'));

        return $query->orderBy('starts_at', 'asc');
    }

    public function setOrder($query, $string)
    {
        $names = ['data' => 'starts_at', 'nome' => 'name'];
        $orders = ['cresc' => 'asc', 'decresc' => 'desc'];
        $array = explode('_', $string);
        
        return $query->orderBy($names[$array[0]], $orders[$array[1]]);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('attendees_count', 'desc');
    }
}
