<?php

namespace Tests\Feature\PagSeguro;

use Tests\AppTest;
use Tests\PagSeguro\Sandbox;
use Tests\Traits\Checkout;
use App\{Event, Workshop, UserWorkshop};

class SimplePaymentTest extends AppTest
{
	use Checkout;

	/** @test */
	public function an_event_updates_its_status_via_notifications()
	{
		$request = $this->fakeEvent('single', Event::class, 'em analise', 'E-REFERENCE', 'newCode');

		$this->assertNull(Event::byReference('E-REFERENCE')->first()->transaction_code);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotNull(Event::byReference('E-REFERENCE')->first()->transaction_code);
		$this->assertEquals('Em análise', Event::byReference('E-REFERENCE')->first()->status);

		$notification = $this->fakeNotification('single', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('E-REFERENCE', 'newCode')]));

		$this->assertEquals('Paga', Event::byReference('E-REFERENCE')->first()->status);
	}

	/** @test */
	public function an_event_payment_is_recorded_upon_every_first_notification()
	{
		$request = $this->fakeEvent('single', Event::class, 'em analise', 'E-REFERENCE', 'newCode');

		$this->assertEmpty($request['event']->creator->payments);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotEmpty($request['event']->creator->fresh()->payments);
	}

	/** @test */
	public function an_event_payment_record_is_updated_with_a_notification()
	{
		$request = $this->fakeEvent('single', Event::class, 'em analise', 'E-REFERENCE', 'newCode');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertCount(1, $request['event']->creator->payments);

		$notification = $this->fakeNotification('single', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('E-REFERENCE', 'newCode')]));

		$this->assertCount(1, $request['event']->creator->fresh()->payments);
	}

	/** @test */
	public function a_user_can_see_any_event_unless_it_has_been_cancelled()
	{
		$request = $this->fakeEvent('single', Event::class, 'em analise', 'E-REFERENCE', 'newCode');

		$event = Event::byReference('E-REFERENCE')->first();

		$this->assertCount(1, $event->creator->eventsArray());

		$notification = $this->fakeNotification('single', 'cancelada');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('E-REFERENCE', 'newCode')]));

		$this->assertCount(0, $event->creator->eventsArray());
	}
}
