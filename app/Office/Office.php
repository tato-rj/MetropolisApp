<?php

namespace App\Office;

abstract class Office
{
	public function __get($property) {
		if (property_exists($this, $property)) {
			return $this->$property;
		}
	}
}
