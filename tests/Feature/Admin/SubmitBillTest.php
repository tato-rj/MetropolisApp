<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\{Admin, User, Bill};
use Tests\Traits\FakeEvents;
use Illuminate\Support\Facades\Mail;
use App\Mail\{ConfirmEvent, EventPayment, BillPayment};

class SubmitBillTest extends AppTest
{	
	use FakeEvents;

    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

	/** @test */
	public function an_admin_can_select_to_bill_a_client_when_creating_an_event()
	{
		Mail::fake();

		$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent($space = null, $this->user);

		$this->assertCount(0, $this->admin->events);

		$this->assertCount(1, $this->user->events()->unpaid()->get());
	}

	/** @test */
	public function when_submitting_a_bill_the_user_receives_a_link_to_pay_the_bill_instead_of_the_confirmation_email()
	{
		Mail::fake();

		$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent($space = null, $this->user);

		$event = $this->user->events()->unpaid()->first();

		$url = route('client.payments.create', ['referencia' => $event->reference]);

		Mail::assertNotQueued(ConfirmEvent::class);

        Mail::assertQueued(EventPayment::class, function ($mail) use ($url) {
            return $mail->url === $url;
        });
	}

	/** @test */
	public function a_user_can_see_the_billing_page_of_an_event_created_by_the_admin()
	{
		$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent($space = null, $this->user);

		$event = $this->user->events()->unpaid()->first();

		$this->signIn($this->user, 'web');
		
		$this->get(route('client.payments.create', ['referencia' => $event->reference]))
			 ->assertSee($event->fee);
	}

	/** @test */
	public function users_are_not_authorized_to_see_bills_sent_to_other_users()
	{
		$this->signIn($this->admin, 'admin');

		$this->adminCreateNewEvent($space = null, $this->user);

		$event = $this->user->events()->unpaid()->first();

		$this->signIn(create(User::class), 'web');

		$this->expectException('Illuminate\Auth\Access\AuthorizationException');

		$this->get(route('client.payments.create', ['referencia' => $event->reference]))
			 ->assertSee($event->fee);		 
	}

	/** @test */
	public function an_admin_can_create_an_submit_a_generic_bill()
	{
		Mail::fake();

		$this->signIn($this->admin, 'admin');
		
		$bill = make(Bill::class);

		$this->post(route('admin.bills.store'), $bill->toArray());

		$bill = Bill::first();

		$this->assertDatabaseHas('bills', ['name' => $bill->name]);

		$url = route('client.payments.bill', ['referencia' => $bill->reference]);

        Mail::assertQueued(BillPayment::class, function ($mail) use ($url) {
            return $mail->url === $url;
        });
	}

	/** @test */
	public function an_admin_can_resubmit_an_existing_generic_bill_without_creating_a_new_one()
	{
		Mail::fake();

		$this->signIn($this->admin, 'admin');
		
		$billRequest = make(Bill::class);

		$this->post(route('admin.bills.store'), $billRequest->toArray());

        Mail::assertQueued(BillPayment::class);

		$bill = Bill::first();

		$this->assertCount(1, Bill::all());

		$this->post(route('admin.bills.store'), $bill->toArray());

        Mail::assertQueued(BillPayment::class);

		$this->assertCount(1, Bill::all());
	}
}
