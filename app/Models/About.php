<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
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
        'content',
        'gambar',
    ];
}
