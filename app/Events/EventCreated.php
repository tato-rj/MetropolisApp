<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\{Event, User};

class EventCreated
{
    use Dispatchable, SerializesModels;

    public $event, $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Event $event, User $user = null)
    {
        $this->event = $event;
        $this->user = $user;
    }
}
