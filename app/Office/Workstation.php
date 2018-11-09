<?php

namespace App\Office;

class Workstation extends Space
{
	public function type()
	{
		return 'workstation';
	}

	public function capacity()
	{
		return 12;
	}

	public function fees()
	{
		return [
				['duration' => 1, 'fee' => 20],
				['duration' => 2, 'fee' => 35],
				['duration' => 4, 'fee' => 60],
				['duration' => $this->office->day_length, 'fee' => 100]
			];
	}

	public function fee($duration, $participants = 1)
	{
		foreach ($this->fees() as $fee) {
			if ($fee['duration'] == $duration)
				return $fee['fee'] * $participants;
		}
	}
}
