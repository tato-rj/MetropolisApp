<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\{User, Workshop};

class WorkshopSignup
{
    use Dispatchable, SerializesModels;

    public $user, $workshop;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Workshop $workshop)
    {
        $this->user = auth()->user();
        $this->workshop = $workshop;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
