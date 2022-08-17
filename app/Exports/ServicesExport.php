<?php

namespace App\Exports;

use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Service;
use App\Models\Car;
use App\Models\Pack;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ServicesExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function __construct(array $params)
    {
        $params = (object) $params;
        $params = (object) $params->form;
        $this->params = $params;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha de creación',
            'Fecha de servicio',
            'Hora de inicio',
            'Hora de fin',
            'Modelo de vehiculo',
            'Marca de vehiculo',
            'Año de vehiculo',
            'Serie de vehiculo',
            'Placas de vehiculo',
            'Nombre de empleado',
            // 'Precio del servicio',

        ];
    }

    public function collection()
    {
        $params = $this->params;
        // dd($params);
        $services = Service::orderBy('id', 'desc');

        if (isset($params->company)) {
            $services = $services->where('company_id', $params->company);
        }
        foreach ($params as $key => $value) {
            if ($key != 'company' && $value != '' && $key != 'from' && $key != 'to') {
                $services->with('car')->whereHas('car', function ($query) use ($key, $value) {
                    $query->where($key, $value);
                    // dd($query->get());
                });
            }
        }
        $services = $services->select([
            'id','created_at', 'date', 'start_time', 'end_time'
        ]);
        $services = $services->addSelect([
                'car_model' => Car::select('model')->whereColumn('services.car_id', 'cars.id'),
                'car_trademark' => Car::select('trademark')->whereColumn('services.car_id', 'cars.id'),
                'car_year' => Car::select('year')->whereColumn('services.car_id', 'cars.id'),
                'car_serie' => Car::select('serie')->whereColumn('services.car_id', 'cars.id'),
                'car_plate' => Car::select('plate')->whereColumn('services.car_id', 'cars.id'),
                'user_name' => User::select('name')->whereColumn('services.user_id', 'users.id'),
                // 'pack_price' => Pack::select('prices')->whereColumn('services.pack_id', 'packs.id')->(),
            ]);
        $services = $services->get();
        // dd($services);
        return $services;
    }
}
