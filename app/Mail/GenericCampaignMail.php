<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericCampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subjectLine;
    public string $htmlBody;

    public function __construct(string $subjectLine, string $htmlBody)
    {
        $this->subjectLine = $subjectLine;
        $this->htmlBody    = $htmlBody;
    }

    public function build()
    {
        return $this
            ->subject($this->subjectLine)
            ->view('emails.layouts.campaign')
            ->with([
                'htmlBody' => $this->htmlBody,
            ]);
    }
}
