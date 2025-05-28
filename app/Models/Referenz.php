<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Referenz extends Model
{
    use HasFactory;

    protected $table = 'referenzes';

    protected $fillable = ['titel', 'beschreibung', 'slug', 'ort', 'bilder'];
    protected $casts = [
        'bilder' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($referenz) {
            $referenz->slug = Str::slug($referenz->titel);
        });

        static::updating(function ($referenz) {
            if ($referenz->isDirty('titel')) {
                $referenz->slug = Str::slug($referenz->titel);
            }
        });
    }
}
