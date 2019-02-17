<?php

namespace App\Listeners\Memberships;

use App\Events\MembershipCreated;
use App\Mail\ConfirmMembership;
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
    public function handle(MembershipCreated $event)
    {
        \Mail::to($event->user->email)->send(new ConfirmMembership($event->user));
    }
}
