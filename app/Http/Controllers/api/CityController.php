<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesCollection;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CitiesCollection(City::all());
        // $cities = City::with('cityGroups')->get();

        // return response()->json($cities, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = new City;

        $request->validate($city->rules(), $city->feedback());

        $citiesAlreadyExists = City::where('city', $request->city)->get(['city', 'uf'])->toArray();

        if ($city->validadeCityAlreadyExists($citiesAlreadyExists, $request)) {
            return response()->json(['error' => 'Cidade já cadastrada.'], 422);
        }

        return response()->json($city->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($city)
    {
        $city = City::with('cityGroup')->find($city);

        if ($city) {
            return new CityResource($city);
            // return response()->json($city, 200);
        }

        return response()->json(['error' => 'Cidade não encontrada.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $city)
    {
        $city = City::find($city);

         if ($city === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, a cidade solicitada não existe.'], 404);
        }

        $request->validate($city->rules(), $city->feedback());

        $citiesAlreadyExists = City::where('city', $request->city)->get(['city', 'uf'])->toArray();

        if ($city->validadeCityAlreadyExists($citiesAlreadyExists, $request)) {
            return response()->json(['error' => 'Cidade já cadastrada.'], 422);
        }

        $city->update($request->all());

        return response()->json($city, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($city)
    {
        $city = City::find($city);

        if ($city) {
            $city->delete();

            return response()->json(['message' => 'A cidade foi removida com sucesso.'], 200);
        }

        return response()->json(['error' => 'Impossível realizar a remoção, a cidade solicitada não existe.'], 404);
    }
}
