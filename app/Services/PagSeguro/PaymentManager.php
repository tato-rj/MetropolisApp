<?php

namespace App\Services\PagSeguro;

use App\Payment;

class PaymentManager
{
	protected $pagseguro;

	public function __construct(PagSeguro $pagseguro)
	{
		$this->pagseguro = $pagseguro;
	}

	public function cancel(Payment $payment)
	{
		try {
		    $response = \PagSeguro\Services\Transactions\Cancel::create($this->pagseguro->credentials, $payment->reservation->transaction_code);
		} catch (Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}

	public function refund(Payment $payment)
	{
		try {
		    $response = \PagSeguro\Services\Transactions\Refund::create($this->pagseguro->credentials, $payment->reservation->transaction_code);
		} catch (Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}
}
