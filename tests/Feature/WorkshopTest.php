<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\Events\WorkshopSignup;
use App\{User, WorkshopFile, Admin, UserWorkshop};
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmWorkshop;

class WorkshopTest extends AppTest
{
    public function setUp()
    {
        parent::setUp();

        $this->admin = create(Admin::class);
    }

	/** @test */
	public function authenticated_users_can_signup_for_a_workshop()
	{
		$this->expectsEvents(WorkshopSignup::class);

		$this->signIn();

		$this->assertFalse(auth()->user()->workshops()->exists());

		$this->signUpToNewWorkshop($this->workshop)->assertSessionHas('status');

		$this->assertTrue(auth()->user()->fresh()->workshops()->exists());

		$this->assertNotNull(auth()->user()->workshops()->first()->reservation->reference);
	}

	/** @test */
	public function unauthenticated_users_cannot_signup_for_a_workshop()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$unauthenticatedUser = create(User::class);
		
		$this->signUpToNewWorkshop($this->workshop, $unauthenticatedUser);
	}

	/** @test */
	public function users_receive_an_email_confirming_the_workshop_signup_containg_all_material_for_download()
	{
		Mail::fake();

		$this->signIn();

		create(WorkshopFile::class, ['workshop_id' => $this->workshop->id]);
		create(WorkshopFile::class, ['workshop_id' => $this->workshop->id]);
		
		$files = $this->workshop->files->pluck('path');

		$this->signUpToNewWorkshop($this->workshop);

        Mail::assertQueued(ConfirmWorkshop::class);
	}

	/** @test */
	public function both_the_user_and_an_admin_can_see_a_button_to_cancel_the_payment_for_a_workshop_reservation()
	{
		$this->signIn();

		$this->signUpToNewWorkshop($this->workshop);

		$reservation = auth()->user()->workshops->first()->pivot;

		$this->get(route('status.workshop', ['reservation_id' => $reservation->id, 'user_type' => get_class(auth()->user())]))->assertSee('Cancelar');

		$this->logout();

		$this->signIn($this->admin, 'admin');

		$this->get(route('status.workshop', ['reservation_id' => $reservation->id, 'user_type' => get_class(auth()->user())]))->assertSee('Cancelar');
	}

	/** @test */
	public function the_option_to_cancel_does_not_appear_for_cancelled_workshop_reservations()
	{
		$this->signIn();

		$this->signUpToNewWorkshop($this->workshop);

		$reservation = auth()->user()->workshops->first()->pivot;

		UserWorkshop::find($reservation->id)->setStatus(7);

		$this->get(route('status.workshop', ['reservation_id' => $reservation->id, 'user_type' => get_class(auth()->user())]))->assertDontSee('Cancelar'); 
	}

	/** @test */
	public function an_authorized_user_can_cancel_an_unconfirmed_workshop_reservation()
	{
		$this->signIn();

		$this->signUpToNewWorkshop($this->workshop);

		$reservation = UserWorkshop::find(auth()->user()->workshops->first()->pivot->id);

		$this->assertFalse($reservation->statusForUser == 'Cancelada');

		$this->post(route('workshops.cancel', ['workshop' => $reservation->workshop->slug, 'reservation_id' => $reservation->id]));

		$this->assertTrue($reservation->fresh()->statusForUser == 'Cancelada');
	}
}
