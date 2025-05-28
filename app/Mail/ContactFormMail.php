<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    /**
     * Erstelle eine neue Nachrichtinstanz.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Baue die Nachricht.
     */
    public function build(): self
    {
        return $this->subject('Neue Kontaktanfrage über antasus.de')
                    ->view('emails.contact-form') // 🔁 exakt dieser Pfad
                    ->with('data', $this->data);
    }
}
