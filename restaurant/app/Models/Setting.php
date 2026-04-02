<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'description',
        'logo',
        'phone',
        'whatsapp',
        'instagram',
        'address',
        'lat',
        'lng',
        'is_active',
        'prep_time',
        'min_order',
        'signe_price',
        'delivery_radius',
        'email',
        'adresse',
        'opening_hours',
        'locale'
    ];

    protected $casts = [
        'cuisine_types' => 'array',
        'opening_hours' => 'array',
        'is_active' => 'boolean',
    ];
}
