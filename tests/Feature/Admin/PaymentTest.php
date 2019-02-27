<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\{Payment, Admin};

class PaymentTest extends AppTest
{
    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

	/** @test */
	public function admins_can_see_details_of_all_payments()
	{
		$this->signIn($this->admin, 'admin');

		$payment = Payment::record($this->event);

		$this->get(route('status.payment', $payment->transaction_code))->assertSee($payment->reservation->statusForUser);
	}
}
