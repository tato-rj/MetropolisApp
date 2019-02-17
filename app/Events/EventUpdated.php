<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\{Event, User};

class EventUpdated
{
    use Dispatchable, SerializesModels;

    public $event;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }
}
