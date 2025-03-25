<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\City;


class LocationController extends Controller
{
    public function getDistricts(Request $request)
    {
        $stateId = $request->query('state_id');

        if (!$stateId) {
            return response()->json(['error' => 'State ID is required'], 400);
        }

        $districts = District::where('state_id', $stateId)
            ->distinct('name') // Ensure distinct district names
            ->get(['id', 'name']);

        return response()->json($districts);
    }

    public function getCities(Request $request)
    {
        $districtId = $request->query('district_id');

        if (!$districtId) {
            return response()->json(['error' => 'District ID is required'], 400);
        }

        $cities = City::where('district_id', $districtId)
            ->get(['id', 'name']);

        return response()->json($cities);
    }
}
