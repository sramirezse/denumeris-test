<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelStationRequest;
use App\Models\FuelStation;
use App\Repositories\FuelStationRepository;
use Illuminate\Http\Request;

class FuelStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FuelStationRequest $request,FuelStationRepository $FuelStationRepository)
    {
        $stations = $FuelStationRepository->getFuelStations($request->state, $request->city, $request->order_by, $request->perPage, $request->offset);
        // dd($stations);
        return response()->json([
            'stations' => $stations['stations'],
            'total' => $stations['total'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelStation  $fuelStation
     * @return \Illuminate\Http\Response
     */
    public function show(FuelStation $fuelStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelStation  $fuelStation
     * @return \Illuminate\Http\Response
     */
    public function edit(FuelStation $fuelStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelStation  $fuelStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelStation $fuelStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelStation  $fuelStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(FuelStation $fuelStation)
    {
        //
    }
}
