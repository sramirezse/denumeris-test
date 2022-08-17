<?php

namespace App\Repositories;

use App\Models\PostalCode;
use App\Models\FuelStation;

class PostalCodeRepository
{
    public function getStates()
    {
        $stateCodes = PostalCode::select('d_estado',)
            ->groupBy('d_estado',)
            ->get();
        return $stateCodes;
    }

    public function getCities($state)
    {
        $cities = PostalCode::where('d_estado','LIKE', "%{$state}%")
        ->select('D_mnpio',)
            ->groupBy('D_mnpio')
            ->get();
        return $cities;
    }
}
