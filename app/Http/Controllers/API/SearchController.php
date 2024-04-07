<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\Product;
use App\Models\PublicFacilityOption;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // change this can break algorithm
        $designOptions = DesignOption::query()->orderByDesc('value')->get();
        $facilityOptions = FacilityOption::query()->orderByDesc('value')->get();
        $locationOptions = LocationOption::query()->orderByDesc('value')->get();
        $publicFacilityOptions = PublicFacilityOption::query()->orderByDesc('value')->get();
        $bedrooms = Product::query()
            ->distinct('bedrooms')->orderByDesc('bedrooms')
            ->selectRaw('bedrooms as value, concat(bedrooms," kamar tidur") as label')->get();
        $bathrooms = Product::query()
            ->distinct('bathrooms')->orderByDesc('bathrooms')
            ->selectRaw('bathrooms as value, concat(bathrooms," kamar mandi") as label')->get();
        $floors = Product::query()
            ->distinct('floors')->orderByDesc('floors')
            ->selectRaw('floors as value, concat(floors," lantai") as label')->get();

        return response([
            'designOptions' => $designOptions,
            'facilityOptions' => $facilityOptions,
            'locationOptions' => $locationOptions,
            'publicFacilityOptions' => $publicFacilityOptions,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'floors' => $floors,
        ]);
    }
}
