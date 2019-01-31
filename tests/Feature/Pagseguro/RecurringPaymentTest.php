<?php

namespace Tests\Feature\PagSeguro;

use Tests\AppTest;
use Tests\PagSeguro\Sandbox;
use Tests\Traits\Checkout;
use App\{Event, Membership};

class RecurringPaymentTest extends AppTest
{
	use Checkout;

	/** @test */
	public function a_recurring_event_knows_if_it_should_just_update_or_renew_its_membership_plan_by_automatically_creating_a_new_event()
	{
		$request = $this->fakeEvent('recurring', Event::class, 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertEquals(1, Event::byReference($request['event']->reference)->count());

		$newNotification = $this->fakeNotification('recurring', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $newNotification->xml($ref = null, $code = '123456')]));
		
		$this->assertEquals(2, Event::byReference($request['event']->reference)->count());
	}

	/** @test */
	public function a_payment_is_recorded_upon_every_first_notification()
	{
		$request = $this->fakeEvent('recurring', Event::class, 'em analise', 'newReference', 'newCode');

		$this->assertEmpty($request['event']->creator->payments);

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$this->assertNotEmpty($request['event']->creator->fresh()->payments);
	}

	/** @test */
	public function a_renewed_event_is_scheduled_for_the_day_after_its_last_event_ends()
	{
		$request = $this->fakeEvent('recurring', Event::class, 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$firstRenew = $this->fakeNotification('recurring', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $firstRenew->xml($ref = null, $code = '123456')]));

		$secondRenew = $this->fakeNotification('recurring', 'paga');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $secondRenew->xml($ref = null, $code = '098766')]));

		$events = Event::byReference('E-REFERENCE')->get();

		$this->assertTrue($events[0]->ends_at->addDay()->isSameDay($events[1]->starts_at));
		$this->assertTrue($events[1]->ends_at->addDay()->isSameDay($events[2]->starts_at));
		$this->assertFalse($events[0]->ends_at->addDay()->isSameDay($events[2]->starts_at));
	}

	/** @test */
	public function a_users_membership_is_not_renewed_if_a_recurring_payment_is_cancelled()
	{
		$request = $this->fakeEvent('recurring', Event::class, 'paga', 'membershipPlan', '12345');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $request['notification']]));

		$eventsCount = Event::count();

		$notification = $this->fakeNotification('recurring', 'cancelada');

		$this->post(route('pagseguro.event.notification', [
			'notificationType' => 'transaction',
			'xml' => $notification->xml('membershipPlan', '09876')]));

		$this->assertEquals($eventsCount, Event::count());

		$this->assertFalse(Membership::byReference('membershipPlan')->first()->isActive());
	}
}
