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

    public function getCurrentCapacityAttribute()
    {
        if ($this->is_shared)
            return $this->capacity - Membership::count();

        return $this->capacity;
    }

    public function priceFor($participants, $duration, $discount = 0)
    {
        $finalDuration = ($duration - $discount) >= 0 ? $duration - $discount : 0;
        
        $fee = $this->fee / 100;

        if (! $this->is_shared)
            return $fee * $finalDuration;

        return $fee * $participants * $duration;
    }

    public function nextBusinessDay($hour = 8)
    {
        if (now()->hour <= office()->day_ends_at && now()->isWeekDay())
            return now()->setTime($hour,0,0);

        $day = now()->copy()->addDay()->setTime($hour,0,0);

        if ($day->isWeekDay())
            return $day;

        return $day->addWeek()->startOfWeek()->setTime($hour,0,0);
    }
}
