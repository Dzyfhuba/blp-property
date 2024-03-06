<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'bedrooms',
        'bathrooms',
        'land_size',
        'facilities',
        'design',
        'location',
        'floors',
        'building_size'
    ];
}
