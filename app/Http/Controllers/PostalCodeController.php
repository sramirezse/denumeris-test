<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostalCodeRequest;
use Illuminate\Http\Request;
use App\Models\PostalCode;
use App\Repositories\PostalCodeRepository;

class PostalCodeController extends Controller
{
    public function getStates(PostalCodeRepository $PostalCodeRepository)
    {
        $states = $PostalCodeRepository->getStates();
        return response()->json([
            'states' => $states,
            'total' => count($states),
        ]);
    }
    public function getCities(PostalCodeRequest $request, PostalCodeRepository $PostalCodeRepository)
    {
        $cities = $PostalCodeRepository->getCities($request->state);
        // dd($cities);
        return response()->json([
            'cities' => $cities,
            'total' => count($cities),
        ]);
    }
}
