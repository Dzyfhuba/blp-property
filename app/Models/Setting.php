<?php

namespace App\Models;

use App\Casts\ArrayInArrayDecimal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Model as ModelTable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'batch',
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

    public function model(): BelongsTo
    {
        return $this->belongsTo(ModelTable::class, 'batch', 'batch');
    }

    // public function models(): BelongsToMany
    // {
    //     return $this->belongsTo(ModelTable::class);
    // }
}
