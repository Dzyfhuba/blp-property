<?php

namespace App\Models;

use App\Casts\ArrayInArrayDecimal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'model_id',
        'contacts',
        'marketing_executives',
        'social_medias',
        'address',
        'google_maps_url',
        'pairwise_comparison'
    ];

    protected $casts = [
        'contacts' => 'array',
        'marketing_executives' => 'array',
        'social_medias' => 'array',
        // 'pairwise_comparison' => ArrayInArrayDecimal::class,
        'pairwise_comparison' => 'array',
    ];
}
