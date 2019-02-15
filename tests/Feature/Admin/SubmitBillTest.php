<?php

namespace Tests\Feature\Admin;

use Tests\AppTest;
use App\{Admin, User};
use Tests\Traits\FakeEvents;
use Illuminate\Support\Facades\Mail;
use App\Mail\{ConfirmEvent, BillEvent};

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

		$user = create(User::class);

		$this->adminCreateNewEvent($space = null, $user);

		$this->assertCount(0, $this->admin->events);

		$this->assertCount(1, $user->events()->unpaid()->get());
	}

	/** @test */
	public function when_submitting_a_bill_the_user_receives_a_link_to_pay_the_bill_instead_of_the_confirmation_email()
	{
		Mail::fake();

		$this->signIn($this->admin, 'admin');

		$user = create(User::class);

		$this->adminCreateNewEvent($space = null, $user);

		$event = $user->events()->unpaid()->first();

		$url = route('client.payments.create', ['referencia' => $event->reference]);

		Mail::assertNotQueued(ConfirmEvent::class);

        Mail::assertQueued(BillEvent::class, function ($mail) use ($url) {
            return $mail->url === $url;
        });
	}

	/** @test */
	public function a_user_can_see_the_billing_page_of_an_event_created_by_the_admin()
	{
		$this->signIn($this->admin, 'admin');

		$user = create(User::class);

		$this->adminCreateNewEvent($space = null, $user);

		$event = $user->events()->unpaid()->first();

		$this->signIn($user, 'web');
		
		$this->get(route('client.payments.create', ['referencia' => $event->reference]))
			 ->assertSee($event->fee);
	}

	/** @test */
	public function users_are_not_authorized_to_see_bills_sent_to_other_users()
	{
		$this->signIn($this->admin, 'admin');

		$user = create(User::class);

		$this->adminCreateNewEvent($space = null, $user);

		$event = $user->events()->unpaid()->first();

		$this->signIn(create(User::class), 'web');

		$this->expectException('Illuminate\Auth\Access\AuthorizationException');

		$this->get(route('client.payments.create', ['referencia' => $event->reference]))
			 ->assertSee($event->fee);		 
	}
}
