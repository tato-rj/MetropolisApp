<?php

namespace App\Traits;

trait GenerateInvoice
{
	public function makeInvoice()
	{
		return ['date' => now(),
				'title' => 'Workshop',
				'reference' => 'reference',
				'amount' => 1000,
				'status' => 'PAID'
			];
	}
}
