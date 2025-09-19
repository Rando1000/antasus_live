<?php

// app/Mail/MeetingConfirmedMail.php

namespace App\Mail;

use App\Models\MeetingBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public MeetingBooking $meeting) {}

    public function build()
    {
        return $this->subject('Ihr Termin bei Antasus Infra ist bestätigt')
            ->view('emails.meeting_confirmed');
    }
}
