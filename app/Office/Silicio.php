<?php

namespace App\Office;

class Silicio extends Space
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
				['duration' => 1, 'fee' => 99],
				['duration' => 2, 'fee' => 189],
				['duration' => 4, 'fee' => 379],
				['duration' => $this->office->day_length, 'fee' => 499]
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
