<?php

namespace App\Listeners\Events;

use App\Events\EventCreated;
use App\Mail\{ConfirmEvent, EventPayment};
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendConfirmationEmail
{
    /**
     * Handle the event.
     *
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
        $mail = $event->user ?  new EventPayment($event->event) : new ConfirmEvent($event->event);

        \Mail::to($event->event->creator->email)->send($mail);
    }
}
