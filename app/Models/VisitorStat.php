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
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOnlyFrontend($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('user_id')
            ->orWhereHas('user', function ($u) {
                $u->whereDoesntHave('roles', function ($r) {
                    $r->where('name', 'admin');
                });
            });
        });
    }
}
