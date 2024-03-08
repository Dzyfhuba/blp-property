<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'user_id',
        'thumbnail',
        'images',
        'tags',
        'content'
    ];
    protected $casts = [
        'tags' => 'array',
        'images' => 'array'
    ];

}
