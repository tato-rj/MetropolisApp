<?php

namespace App\Listeners\Workshops;

use App\Events\WorkshopSignup;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ConfirmWorkshop;

class SendConfirmationEmail
{
    /**
     * Handle the event.
     *
     * @param  WorkshopSignup  $event
     * @return void
     */
    public function handle(WorkshopSignup $event)
    {
        \Mail::to($event->user->email)->send(new ConfirmWorkshop($event->workshop, $event->user));
    }
}
