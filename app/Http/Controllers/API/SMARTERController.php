<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SMARTERController extends Controller
{
    public function calculate(Request $request){
        // Validation
        $validator = Validator::make($request->all(), [
            'price' => 'required|numeric|min:300|max:1000',
            'bedrooms' => 'required|numeric',
            'bathrooms' => 'required|numeric',
            'land_size' => 'required|numeric',
            'facility' => 'required|numeric',
            'public_facility' => 'required',
            'design' => 'required',
            'location' => 'required',
            'floors' => 'required',
            'building_size' => 'required',
        ]);

        if ($validator->fails()) {
            return response([
                'error' => $validator->getMessageBag()
            ], 400);
        }

        return response([
            'request' => $request->all()
        ]);
    }
}
