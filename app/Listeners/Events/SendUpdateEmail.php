<?php

namespace App\Listeners\Events;

use App\Events\EventUpdated;
use App\Mail\UpdateEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUpdateEmail
{
    /**
     * Handle the event.
     *
     * @param  EventUpdated  $event
     * @return void
     */
    public function handle(EventUpdated $event)
    {
        \Mail::to($event->event->creator->email)->send(new UpdateEvent($event->event));
    }
}
