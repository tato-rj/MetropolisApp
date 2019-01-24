<?php

namespace App\Services\PagSeguro\Contracts;

use App\User;

interface Checkout
{
	public function purchase($reference);
}
