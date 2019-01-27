<?php

namespace Tests\Feature\PagSeguro;

use Tests\AppTest;
use Tests\PagSeguro\Sandbox;
use Tests\Traits\Checkout;
use App\Event;

class SimplePaymentTest extends AppTest
{
	use Checkout;

	/** @test */
	public function an_event_updates_its_status_via_notifications()
	{
		$request = $this->fakeEvent('single', 'em analise', 'newReference', 'newCode');

		$this->assertNull($request['event']->transaction_code);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotNull($request['event']->fresh()->transaction_code);
		$this->assertEquals('Em análise', $request['event']->fresh()->status);

		$notification = $this->fakeNotification('single', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('newReference', 'newCode')]));

		$this->assertEquals('Paga', $request['event']->fresh()->status);
	}

	/** @test */
	public function a_user_can_see_any_event_unless_it_has_been_cancelled()
	{
		$request = $this->fakeEvent('single', 'em analise', 'newReference', 'newCode');

		$event = Event::byReference('newReference')->first();

		$this->assertCount(1, $event->creator->eventsArray);

		$notification = $this->fakeNotification('single', 'cancelada');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('newReference', 'newCode')]));

		$this->assertCount(0, $event->creator->eventsArray);
	}
}
