<?php

namespace App\Traits;

trait Office
{
	protected $day_length = 10;
	protected $day_starts_at = 8;
	protected $day_ends_at = 18;

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
}

