<?php

namespace App\Listeners\Events;

use App\Events\EventCreated;
use App\Mail\ConfirmEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
        Mail::to($event->event->creator->email)->send(new ConfirmEvent($event->event));
    }
}
