<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\Bill;

class BillTest extends AppTest
{
	/** @test */
	public function an_authenticated_user_can_pay_a_generic_bill()
	{
		$this->signIn();

		$bill = create(Bill::class);

		$request = array_merge($bill->toArray(), $this->cardFields);

		$this->post(route('client.payments.bill.purchase'), $request)->assertSessionHas('status');
	}
}
