<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterionRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria',
        'rating',
    ];

    protected $casts = [
        'rating' => 'array'
    ];
}
