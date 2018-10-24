<?php

namespace App\Office;

use App\Event;

abstract class Space
{
	abstract protected function type();
	abstract protected function fees();
	abstract protected function fee($duration, $participants);
	abstract protected function capacity();

	public function __construct()
	{
		$this->office = new Office;
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}

	public function events()
	{
		return Event::where('type', get_class($this))->get();
	}
}
