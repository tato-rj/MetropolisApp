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

	/** @test */
	public function the_admin_sees_a_button_to_cancel_a_payment_if_its_status_is_not_yet_paid()
	{
		$this->signIn($this->admin, 'admin');

		$payment = Payment::record($this->event);

		$this->get(route('status.payment', $payment->transaction_code))->assertSee('Cancelar pagamento');

		$payment->reservation->setStatus(3);

		$this->get(route('status.payment', $payment->transaction_code))->assertDontSee('Cancelar pagamento');
	}

	/** @test */
	public function the_admin_sees_a_button_to_return_a_payment_if_its_status_paid()
	{
		$this->signIn($this->admin, 'admin');

		$payment = Payment::record($this->event);

		$payment->reservation->setStatus(3);

		$this->get(route('status.payment', $payment->transaction_code))->assertDontSee('Cancelar pagamento');
		$this->get(route('status.payment', $payment->transaction_code))->assertSee('Estornar o pagamento');
	}
}
