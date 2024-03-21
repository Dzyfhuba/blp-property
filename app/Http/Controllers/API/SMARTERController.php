<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use App\Models\Setting;
use Illuminate\Http\Request;

class SMARTERController extends Controller
{
    public function options(){
        $designOptions = DesignOption::all();
        $facilityOptions = FacilityOption::all();
        $locationOptions = LocationOption::all();
        $publicFacilityOptions = PublicFacilityOption::all();

        return response([
            'options' => [
                'designOptions' => $designOptions,
                'facilityOptions' => $facilityOptions,
                'locationOptions' => $locationOptions,
                'publicFacilityOptions' => $publicFacilityOptions,
            ]
        ]);
    }
}
