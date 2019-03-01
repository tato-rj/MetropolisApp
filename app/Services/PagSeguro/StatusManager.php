<?php

namespace App\Services\PagSeguro;

use PagSeguro\Services\Transactions\Search\Code;
use App\{Payment, Membership};

class StatusManager
{
	protected $pagseguro;

	public function __construct(PagSeguro $pagseguro)
	{
		$this->pagseguro = $pagseguro;
	}

	public function toggle(Membership $membership)
	{
		$status = new \PagSeguro\Domains\Requests\DirectPreApproval\Status();

		try {
			$status->setPreApprovalCode($membership->transaction_code);

			$newStatus = $membership->isActive() ? 'SUSPENDED' : 'ACTIVE';

			$status->setStatus($newStatus);
			
		    $response = $status->register($this->pagseguro->credentials);
		} catch (\Exception $e) {
		    abort(404, $e->getMessage());
		}

		return $response;
	}
}
