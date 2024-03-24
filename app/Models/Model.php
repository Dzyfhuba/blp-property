<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ModelElo;

class Model extends ModelElo
{
    use HasFactory;

    protected $fillable = [
        'batch',
        'product_id',
        'criterion',
        'total'
    ];

    protected $casts = [
        'criterion' => 'array'
    ];
}
