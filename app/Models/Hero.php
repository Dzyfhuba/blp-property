<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
