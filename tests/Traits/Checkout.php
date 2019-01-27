<?php

namespace Tests\Traits;

use Tests\PagSeguro\Sandbox;

trait Checkout
{
	public function fakeNotification($type, $event)
	{
		$sandbox = new Sandbox;

		return  $sandbox->notification($type)->event($event);
	}

	public function fakeEvent($type, $event, $reference = null, $code = null)
	{
		$reference = $reference ?? 'TEST-REFERENCE';

		$membership = create('App\Membership', ['reference' => $reference]);

		$sandbox = new Sandbox;

		$request = $sandbox->notification($type)->event($event);

		$event = create('App\Event', [
			'creator_id' => $membership->user_id,
			'plan_id' => $membership->plan->id,
			'reference' => $request->key('reference', $reference, $code),
			'ends_at' => $membership->next_payment_at->subDay()]);

		return ['notification' => $request->xml($reference, $code), 'event' => $event];
	}
}
