<?php

namespace App\Services\PagSeguro;

use PagSeguro\Services\Transactions\Search\Reference;
use App\Event;

class StatusManager
{
	protected $pagseguro, $event;

	public function __construct(PagSeguro $pagseguro, Event $event)
	{
		$this->pagseguro = $pagseguro;
		$this->event = $event;
	}

	public function checkEvent($options)
	{
        try {
            return Reference::search($this->pagseguro->credentials, $this->event->reference, $options);
        } catch (\Exception $e) {
            dd($e);
        }
	}

	public function checkPlan($options)
	{
        try {
            return \PagSeguro\Services\Transactions\Search\Date::search($this->pagseguro->credentials, $options);
        } catch (\Exception $e) {
            dd($e);
        }
	}
}
