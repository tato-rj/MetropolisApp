<?php

namespace Tests\PagSeguro;

use Tests\PagSeguro\Notifications\{MembershipNotifications, RecurringNotifications, SingleNotifications};

class Sandbox
{
	use MembershipNotifications, RecurringNotifications, SingleNotifications;

	protected $notificationType;
	protected $notification;

	public function notification($type)
	{
		$this->notificationType = strtolower($type) . '_';

		return $this;
	}

	public function event($name)
	{
		$notificationName = str_replace(' ', '_', strtolower($name));
		$this->notification = $this->notificationType . $notificationName;

		return $this;
	}

	public function xml($reference = null, $code = null)
	{
		$method = $this->notification;
		return $this->$method($reference, $code);
	}

	public function parsed($reference = null, $code = null)
	{
		$method = $this->notification;
		return simplexml_load_string($this->$method($reference, $code));
	}

	public function key($key, $reference = null, $code = null)
	{
		$method = $this->notification;
		$obj = simplexml_load_string($this->$method($reference, $code));

		return (string)$obj->$key;
	}
}
