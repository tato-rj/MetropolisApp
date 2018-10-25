<?php

namespace App\Office;

class Conference extends Space
{
	public function type()
	{
		return 'conference';
	}

	public function capacity()
	{
		return 6;
	}

	public function fees()
	{
		return [
				['duration' => 1, 'fee' => 80],
				['duration' => 2, 'fee' => 140],
				['duration' => 4, 'fee' => 220],
				['duration' => $this->office->day_length, 'fee' => 400]
			];
	}

	public function fee($duration, $participants = null)
	{
		foreach ($this->fees() as $fee) {
			if ($fee['duration'] == $duration)
				return $fee['fee'];
		}
	}
}
