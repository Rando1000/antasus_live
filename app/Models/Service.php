<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'icons',
        'image',
        'position',
        'is_active',
    ];

    protected $casts = [
        'icons' => 'array',
        'is_active' => 'boolean',
    ];

    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }
}
