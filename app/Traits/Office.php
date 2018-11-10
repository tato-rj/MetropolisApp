<?php

namespace App\Traits;

trait Office
{
	protected $day_length = 10;
	protected $day_starts_at = 8;
	protected $day_ends_at = 18;
	protected $holidays = ['12/24', '12/25', '01/01'];

	public function getDayLengthAttribute()
	{
		return $this->day_length;
	}

	public function getDayStartsAtAttribute()
	{
		return $this->day_starts_at;
	}

	public function getDayEndsAtAttribute()
	{
		return $this->day_ends_at;
	}

	public function isWorkingDay($date)
	{
		if (app()->environment() == 'testing') return true;

		return $date->isWeekDay() && ! in_array($date->format('m/d'), $this->holidays);
	}
}

