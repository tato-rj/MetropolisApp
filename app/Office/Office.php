<?php

namespace App\Office;

class Office
{
	private $day_length = 10;
	private $day_starts_at = 8;
	private $day_ends_at = 18;

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function conference()
	{
		return new Conference;
	}

	public function coworking()
	{
		return new CoWorking;
	}

	public function monthly($discount = 100)
	{
		$fees = $this->coworking()->fees();

		$cost = end($fees)['fee'] * 20;
		
		$difference = $cost * ($discount / 100);
		
		return $cost - $difference;
	}
}
