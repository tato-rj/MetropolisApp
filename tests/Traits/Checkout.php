<?php

namespace Tests\Traits;

use Tests\PagSeguro\Sandbox;
use App\{Event, Space, Workshop, Membership};

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
		if ($class == Event::class)
			return $this->newEvent($request, $reference, $code);

		if ($class == Workshop::class)
			return $this->newWorkshopSignup($request, $reference, $code);
	}

	public function newEvent($request, $reference, $code)
	{
		$membership = create(Membership::class, ['reference' => $reference]);
		$space = create(Space::class);

		return create(Event::class, [
			'transaction_code' => null,
			'creator_id' => $membership->user_id,
			'creator_type' => get_class($membership->user),
			'plan_id' => $membership->plan->id,
			'space_id' => $space->id,
			'reference' => $request->key('reference', $reference, $code),
			'ends_at' => $membership->next_payment_at->subDay()]);
	}

	public function newWorkshopSignup($request, $reference, $code)
	{
		$workshop = create(Workshop::class);

		return auth()->user()->signup($workshop, $reference);
	}
}
