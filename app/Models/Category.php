<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'images_top',
        'images_bottom',
        'details'
    ];

    protected $casts = [
        'images_top' => 'array',
        'images_bottom' => 'array',
        'details' => 'array',
    ];
}
