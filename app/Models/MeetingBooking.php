<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingBooking extends Model
{
    protected $fillable = [
        'type',
        'mode',
        'start',
        'end',
        'name',
        'email',
        'topic',
        'status',
        'confirmation_token',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}
