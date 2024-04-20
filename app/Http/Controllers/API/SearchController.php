<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CriterionRating;
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
        // get all criterion ratings and map it, so it can suit with search engine form
        $criterionRatings = CriterionRating::all()->mapWithKeys(fn($item, $idx) => [
            $item['criteria'] => array_map(fn($subitem) => [
                'label' => "{$subitem['label']}: {$subitem['range']}",
                'value' => $subitem['value']
            ], $item['rating'])
        ]);

        return response($criterionRatings);
    }
}
