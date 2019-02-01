<?php

namespace Tests\Feature\PagSeguro;

use Tests\AppTest;
use Tests\PagSeguro\Sandbox;
use Tests\Traits\Checkout;
use App\{Workshop, UserWorkshop};

class WorkshopPaymentTest extends AppTest
{
	use Checkout;

	/** @test */
	public function a_workshop_signup_updates_its_status_via_notifications()
	{
		$this->signIn();

		$request = $this->fakeEvent('single', Workshop::class, 'em analise', 'W-REFERENCE', 'newCode');

		$this->assertNull(UserWorkshop::byReference('W-REFERENCE')->first()->transaction_code);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotNull(UserWorkshop::byReference('W-REFERENCE')->first()->transaction_code);

		$this->assertEquals('Em análise', UserWorkshop::byReference('W-REFERENCE')->first()->status);

		$notification = $this->fakeNotification('single', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('W-REFERENCE', 'newCode')]));

		$this->assertEquals('Paga', UserWorkshop::byReference('W-REFERENCE')->first()->status);
	}

	/** @test */
	public function a_workshop_payment_is_recorded_upon_every_first_notification()
	{
		$this->signIn();

		$request = $this->fakeEvent('single', Workshop::class, 'em analise', 'W-REFERENCE', 'newCode');

		$this->assertEmpty(UserWorkshop::byReference('W-REFERENCE')->first()->workshop->attendees()->find(auth()->user()->id)->payments);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotEmpty(UserWorkshop::byReference('W-REFERENCE')->first()->workshop->attendees()->find(auth()->user()->id)->fresh()->payments);
	}

	/** @test */
	public function a_workshop_payment_record_is_updated_with_a_notification()
	{
		$this->signIn();

		$request = $this->fakeEvent('single', Workshop::class, 'em analise', 'W-REFERENCE', 'newCode');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertCount(1, UserWorkshop::byReference('W-REFERENCE')->first()->workshop->attendees()->find(auth()->user()->id)->payments);

		$notification = $this->fakeNotification('single', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('W-REFERENCE', 'newCode')]));

		$this->assertCount(1, UserWorkshop::byReference('W-REFERENCE')->first()->workshop->attendees()->find(auth()->user()->id)->fresh()->payments);
	}
}
