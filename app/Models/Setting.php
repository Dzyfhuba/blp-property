<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'weight_product_criterion',
        'contacts',
        'marketing_executives',
        'social_medias',
        'address',
        'google_maps_url',
    ];

    protected $casts = [
        'weight_product_criterion' => 'array',
        'contacts' => 'array',
        'marketing_executives' => 'array',
        'social_medias' => 'array',
    ];
}
