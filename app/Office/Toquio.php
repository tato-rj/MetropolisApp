<?php

namespace App\Office;

class Toquio extends Space
{
	public function type()
	{
		return 'conference';
	}

	public function capacity()
	{
		return 4;
	}

	public function fees()
	{
		return [
				['duration' => 1, 'fee' => 49],
				['duration' => 2, 'fee' => 89],
				['duration' => 4, 'fee' => 169],
				['duration' => $this->office->day_length, 'fee' => 249]
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
