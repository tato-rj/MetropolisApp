<?php

namespace App\Listeners\Events;

use App\Events\EventCreated;
use App\Mail\InviteToEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Newsletter;

class SendInvitationEmail
{
    /**
     * Handle the event.
     *
     * @param  EventCreated  $event
     * @return void
     */
    public function handle(EventCreated $event)
    {
        if ($event->event->emails) {
            foreach ($event->event->emails as $email) {
                if ($email) {
                    \Mail::to($email)->send(new InviteToEvent($event->event));
                    Newsletter::storeOrFail($email);
                }
            }
        }
    }
}
