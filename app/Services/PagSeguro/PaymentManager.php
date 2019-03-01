<?php

namespace App\Services\PagSeguro;

use App\{Event, Membership};
use App\Contracts\Reservation;

class PaymentManager
{
	protected $pagseguro;

	public function __construct(PagSeguro $pagseguro)
	{
		$this->pagseguro = $pagseguro;
	}

	public function cancel(Reservation $event)
	{
		try {
		    $response = \PagSeguro\Services\Transactions\Cancel::create($this->pagseguro->credentials, $event->transaction_code);
		} catch (Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}

	public function refund(Reservation $event)
	{
		try {
		    $response = \PagSeguro\Services\Transactions\Refund::create($this->pagseguro->credentials, $event->transaction_code);
		} catch (Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}

	public function unsubscribe(Membership $membership)
	{
		$status = new \PagSeguro\Domains\Requests\DirectPreApproval\Cancel();

		try {
			$status->setPreApprovalCode($membership->transaction_code);
			
		    $response = $status->register($this->pagseguro->credentials);
		} catch (Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}
}
