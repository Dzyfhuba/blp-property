<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->user_id = auth()->id();
        });
    }

    protected $fillable = [
        'user_id',
        'title',
        'subtitle',
        'content',
        'thumbnail',
        'images',
        'tags',
    ];

    // cast
    protected $casts = [
        'images' => 'array',
        'tags' => 'array'
    ];
}
