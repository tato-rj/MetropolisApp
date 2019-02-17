<?php

namespace Tests\Feature;

use Tests\AppTest;
use App\Events\WorkshopSignup;
use App\{User, WorkshopFile};
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmWorkshop;

class WorkshopTest extends AppTest
{
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
}
