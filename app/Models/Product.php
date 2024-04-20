<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Model as ModelTable;

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
        'images'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(FacilityOption::class, 'facility_option_id');
    }

    public function publicFacility(): BelongsTo
    {
        return $this->belongsTo(PublicFacilityOption::class, 'public_facility_option_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(LocationOption::class, 'location_option_id');
    }

    public function design(): BelongsTo
    {
        return $this->belongsTo(LocationOption::class, 'design_option_id');
    }

    public function models(): HasMany
    {
        return $this->hasMany(ModelTable::class);
    }
}
