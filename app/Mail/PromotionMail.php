<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromotionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;
    public $templateView;
    public $subjectLine;
    public $dynamicData;

    /**
     * @param string $recipientName  Name des Empfängers
     * @param string $templateView   Blade-View (z.B. "emails.promotions.template1")
     * @param string $subjectLine    E-Mail-Betreff
     * @param array  $dynamicData    Beliebige Platzhalter-Daten
     */
    public function __construct(string $recipientName, string $templateView, string $subjectLine, array $dynamicData = [])
    {
        $this->recipientName = $recipientName;
        $this->templateView  = $templateView;
        $this->subjectLine   = $subjectLine;
        $this->dynamicData   = $dynamicData;
    }

    public function build()
    {
        return $this
            ->subject($this->subjectLine)
            ->view($this->templateView)
            ->with(array_merge(
                ['recipientName' => $this->recipientName],
                $this->dynamicData
            ));
    }
}
