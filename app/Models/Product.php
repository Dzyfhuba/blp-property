<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'facility_option_id',
        'public_facility_option_id',
        'design_option_id',
        'location_option_id',
        'floors',
        'building_size',
        'capacity',
        'occupied',
    ];
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
