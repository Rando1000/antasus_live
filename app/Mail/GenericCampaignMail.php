<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GenericCampaignMail extends Mailable
{
    public function __construct(
        public string $subjectLine,
        public string $htmlBody,
        public ?string $preheader = null,
        public ?string $ctaUrl = null,
        public ?string $ctaLabel = null,
        public ?string $footerLink1 = null,
        public ?string $footerLink2 = null,
        public ?string $footerLink3 = null,
    ) {}

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
                'footerLink1' => $this->footerLink1,
                'footerLink2' => $this->footerLink2,
                'footerLink3' => $this->footerLink3,
            ]);
    }
}
