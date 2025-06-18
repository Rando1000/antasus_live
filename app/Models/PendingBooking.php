<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendingBooking extends Model
{
    protected $fillable = [
        'type',
        'mode',
        'start',
        'end',
        'name',
        'email',
        'topic',
        'token',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}
