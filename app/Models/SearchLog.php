<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_ip',
        'user_agent',
        'model_batch',
        'criterion',
        'total',
    ];

    protected $casts = [
        'criterion' => 'array'
    ];
}
