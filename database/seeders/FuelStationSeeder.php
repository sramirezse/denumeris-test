<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FuelStation;
use Illuminate\Support\Facades\Http;

class FuelStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // dd('FuelStationSeeder');
        $response = Http::get('https://api.datos.gob.mx/v1/precio.gasolina.publico')->json();
        $total = $response['pagination']['total'];
        // dd($total);
        $data = Http::get('https://api.datos.gob.mx/v1/precio.gasolina.publico?pageSize='.$total)->json();
        foreach($data['results'] as $station) {
            FuelStation::create([
                'calle' => $station['calle'],
                'rfc' => $station['rfc'],
                'date_insert' => $station['date_insert'],
                'regular' => $station['regular'],
                'premium' => $station['premium'],
                'colonia' => $station['colonia'],
                'razonsocial' => $station['razonsocial'],
                'codigopostal' => $station['codigopostal'],
                'latitude' => $station['latitude'],
                'longitude' => $station['longitude'],
                'dieasel' => $station['dieasel'],
            ]);
        }
    }
}
