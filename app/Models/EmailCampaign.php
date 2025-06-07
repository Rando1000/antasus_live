<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCampaign extends Model
{
     protected $fillable = [
        'recipient_email', 'subject','template','body',
        'sent_at','responded','responded_at',
        'contact_name','contact_email','contact_phone',
    ];
    protected $casts = [
        'sent_at'      => 'datetime',
        'responded_at' => 'datetime',
        'responded'    => 'boolean',
    ];
}
