<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PendingBooking;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(PendingBooking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        return $this->view('emails.confirm-booking')
                    ->with(['booking' => $this->booking]);
    }
}
