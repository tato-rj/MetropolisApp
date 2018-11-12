<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\{Office, FindBySlug, Scheduler};

class Space extends Model
{
	use Office, FindBySlug, Scheduler;

	protected $guarded = [];
	protected $casts = ['is_shared' => 'boolean'];
	protected $dates = ['start_at', 'ends_at'];

    public function events()
    {
    	return $this->hasMany(Event::class);
    }

    public function getNameAttribute()
    {
    	$prefix = $this->type == 'sala de reunião' ? 'Sala ' : null;
    	return $prefix.$this->nickname;
    }

    public function getIconAttribute()
    {
    	return $this->type == 'workstation' ? 'laptop' : 'users';
    }

    public function getCapacityAttribute($capacity)
    {
        if ($this->is_shared)
            return $capacity - Membership::count();

        return $capacity;
    }

    public function priceFor($participants, $duration)
    {
        if (! $this->is_shared)
            return $this->fee * $duration;

        return $this->fee * $participants * $duration;
    }
}
