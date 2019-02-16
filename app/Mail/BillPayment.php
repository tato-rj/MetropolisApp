<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Contracts\Reservation;

class BillPayment extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $event, $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $event)
    {
        $this->event = $event;
        $this->url = route('client.payments.bill', ['referencia' => $this->event->reference]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cobrança do MetropolisRio')->markdown('emails.bills.payment');
    }
}
