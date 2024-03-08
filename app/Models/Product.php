<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
        'bedrooms',
        'bathrooms',
        'land_size',
        'facility_id',
        'public_facility_id',
        'design_id',
        'location_id',
        'floors',
        'building_size'
    ];
    
    public function category(): HasOne
    {
        return $this->hasOne(Category::class);
    }
}
