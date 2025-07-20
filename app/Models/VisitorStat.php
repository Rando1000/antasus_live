<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    public $timestamps = false;

        protected $fillable = [
        'session_id', 'user_id', 'ip_address', 'user_agent', 'device_type',
        'browser', 'os', 'url', 'referer', 'country', 'region', 'city', 'language', 'visited_at'
    ];

        protected $casts = [
            'visited_at' => 'datetime',
        ];
}
