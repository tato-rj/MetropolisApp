<?php

namespace App\Listeners\Events;

use App\Events\EventCreated;
use App\Mail\{ConfirmEvent, BillEvent};
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
        $mail = $event->user ?  new BillEvent($event->event) : new ConfirmEvent($event->event);

        Mail::to($event->event->creator->email)->send($mail);
    }
}
