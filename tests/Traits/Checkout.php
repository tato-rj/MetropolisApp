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

	public function fakeEvent($type, $eventModel, $notificationType, $reference = null, $code = null)
	{
		$reference = $reference ?? 'E-REFERENCE';

		$sandbox = new Sandbox;

		$request = $sandbox->notification($type)->event($notificationType);

		$event = $this->classToEvent($eventModel, $request, $reference, $code);

		return ['notification' => $request->xml($reference, $code), 'event' => $event];
	}

	public function classToEvent($class, $request, $reference, $code)
	{
		if ($class == 'App\Event')
			return $this->newEvent($request, $reference, $code);

		if ($class == 'App\Workshop')
			return $this->newWorkshopSignup($request, $reference, $code);
	}

	public function newEvent($request, $reference, $code)
	{
		$membership = create('App\Membership', ['reference' => $reference]);

		return create('App\Event', [
			'transaction_code' => null,
			'user_id' => $membership->user_id,
			'plan_id' => $membership->plan->id,
			'reference' => $request->key('reference', $reference, $code),
			'ends_at' => $membership->next_payment_at->subDay()]);
	}

	public function newWorkshopSignup($request, $reference, $code)
	{
		$workshop = create('App\Workshop');

		return auth()->user()->signup($workshop, $reference);
	}
}
