<?php

namespace App\Listeners\Bills;

use App\Events\BillCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\BillPayment;

class SendBillingEmail
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
     * @param  BillCreated  $event
     * @return void
     */
    public function handle(BillCreated $event)
    {
        \Mail::to($event->bill->recipient_email)->send(new BillPayment($event->bill));
    }
}
