<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\Model;
use App\Models\PublicFacilityOption;
use App\Models\SearchLog;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SMARTERController extends Controller
{
    public function showProcess(int $searchId)
    {
        $setting = Setting::first(['batch', 'pairwise_comparison']);

        $models = Model::query()
            ->where('batch', $setting->batch)
            ->with('product')
            ->get();

        $search = SearchLog::find($searchId, ['criterion', 'total']);

        return response([
            'models' => $models,
            'search' => $search,
            'pairwise_comparison' => $setting->pairwise_comparison
        ]);
    }
}
