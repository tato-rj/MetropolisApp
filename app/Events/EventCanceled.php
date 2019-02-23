<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\Contracts\Reservation;

class EventCanceled
{
    use Dispatchable, SerializesModels;

    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reservation $event)
    {
        $this->event = $event;
    }
}
