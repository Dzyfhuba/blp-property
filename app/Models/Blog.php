<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'tags',
        'thumbnail',
        'user_id',
        'public',
    ];

    protected $casts = [
        'tags' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            if (auth()->id()) {
                $query->user_id = auth()->id();
            }
        });
    }
}
