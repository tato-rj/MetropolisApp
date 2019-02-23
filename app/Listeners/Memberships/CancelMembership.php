<?php

namespace App\Listeners\Memberships;

use App\Events\EventCanceled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelMembership
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  EventCanceled  $event
     * @return void
     */
    public function handle(EventCanceled $event)
    {
        //
    }
}
