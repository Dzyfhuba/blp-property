<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ModelElo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Model extends ModelElo
{
    use HasFactory;

    protected $fillable = [
        'batch',
        'product_id',
        'criterion',
        'total',
        'pairwise_comparison_normalized',
        'pairwise_comparison_priority',
        'pairwise_comparison_line_quality',
        'pairwise_comparison_consistency_ratio',
    ];

    protected $casts = [
        'criterion' => 'array',
        'pairwise_comparison_normalized' => 'array',
        'pairwise_comparison_priority' => 'array',
        'pairwise_comparison_line_quality' => 'array',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
