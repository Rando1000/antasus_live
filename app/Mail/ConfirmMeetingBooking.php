<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmMeetingBooking extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;


    public function __construct(MeetingBooking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->view('emails.confirm-booking')
                    ->with(['booking' => $this->booking]);
    }
}

