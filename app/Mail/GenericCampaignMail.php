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
    public ?string $preheader;
    public ?string $ctaUrl;
    public ?string $ctaLabel;

    public function __construct(
        string $subjectLine,
        string $htmlBody,
        ?string $preheader = null,
        ?string $ctaUrl = null,
        ?string $ctaLabel = null
    ) {
        $this->subjectLine = $subjectLine;
        $this->htmlBody    = $htmlBody;
        $this->preheader   = $preheader;
        $this->ctaUrl      = $ctaUrl;
        $this->ctaLabel    = $ctaLabel;
    }

    public function build()
    {
        return $this
            ->subject($this->subjectLine)
            ->view('emails.layouts.campaign')
            ->with([
                'subjectLine' => $this->subjectLine,
                'htmlBody'    => $this->htmlBody,
                'preheader'   => $this->preheader,
                'ctaUrl'      => $this->ctaUrl,
                'ctaLabel'    => $this->ctaLabel,
            ]);
    }
}
