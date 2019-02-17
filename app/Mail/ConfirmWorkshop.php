<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\{Workshop, User};

class ConfirmWorkshop extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $workshop, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Workshop $workshop, User $user)
    {
        $this->workshop = $workshop;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Workshop confirmado!')->markdown('emails.workshops.confirm');
    }
}
