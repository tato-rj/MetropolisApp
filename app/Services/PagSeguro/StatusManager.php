<?php

namespace App\Services\PagSeguro;

use PagSeguro\Services\Transactions\Search\Code;
use App\Payment;

class StatusManager
{
	protected $pagseguro, $payment, $status;

	public function __construct(PagSeguro $pagseguro, Payment $payment)
	{
		$this->pagseguro = $pagseguro;
		$this->payment = $payment;
	}

	public function get()
	{     
        try {
            $response = Code::search($this->pagseguro->credentials, $this->payment->reservation->transaction_code);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }

		$this->status = $response->getStatus();

		$this->payment->reservation->setStatus($this->status);
        
        return $this->status;
	}
}
