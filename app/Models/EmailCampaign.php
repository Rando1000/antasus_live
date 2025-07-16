<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
    protected $fillable = [
        'recipient_email', 'subject', 'template', 'body', 'sent_at', 'responded', 'responded_at',
        'contact_name', 'contact_email', 'contact_phone',
        'tracking_token', 'opened_at', 'clicked_links',
    ];

    protected $casts = [
        'sent_at'      => 'datetime',
        'responded_at' => 'datetime',
        'responded'    => 'boolean',
        'opened_at'    => 'datetime',
        'clicked_links'=> 'array',
    ];
}
