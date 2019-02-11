<?php

namespace App\Office;

use App\Space;

class Report extends Office
{
	protected $space, $date, $status, $participantsLeft;

	public function __construct(Space $space, $date, $status, $participantsLeft = null)
	{
		$this->space = $space;
		$this->date = $date;
		$this->status = $status;
		$this->participantsLeft = $participantsLeft;
		$this->participantsExceeded = $participantsLeft < 0 ? $participantsLeft * -1 : null;
	}

	public function getMessage()
	{
		if (! office()->isWorkingDay($this->date))
			return 'O escritório está fechado no dia '.$this->date->format('d/m').'.';

		if ($this->participantsLeft > 0)
			return 'Temos apenas <strong>'.$this->participantsLeft.'</strong> lugares disponíveis entre os horários que você procurou.';

		return 'Infelizmente a <strong>'.$this->space->name.'</strong> não está disponível nesse horário.';
	}
}
