<?php

namespace App\Repositories;

use App\Models\PostalCode;
use App\Models\FuelStation;

class FuelStationRepository
{
    public function getFuelStations($state, $city, $orderBy = 'desc', $perPage = 15, $offset = 0)
    {
        $codes = $this->getPostalCodes($state, $city);
        $stations = FuelStation::whereIn('codigopostal', $codes)
        ->where('latitude', '!=', 0)
        ->where('longitude', '!=', 0);
        $total = count($stations->get());

            $stations = $stations->orderBy('id', $orderBy)
            ->limit($perPage)
            ->offset($offset)
            ->get();


        return [
            'stations' => $stations,
            'total' => $total,
        ];
    }

    private function getPostalCodes($state, $city)
    {
        $stateCodes = PostalCode::where('d_estado', 'LIKE', "%{$state}%")
            ->where('d_mnpio', 'LIKE', "%{$city}%")
            ->select('d_codigo')
            ->groupBy('d_codigo')
            ->get();
        $codes = [];
        foreach ($stateCodes as $code) {
            array_push($codes, $code->d_codigo);
        }
        return $codes;
    }

}
