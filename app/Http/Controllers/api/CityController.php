<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::with('cityGroups')->get();

        return response()->json($cities, 200);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::with('cityGroups')->find($id);

        if ($city === null) {
            return response()->json(['error' => 'Cidade não encontrada.'], 404);
        }

        return response()->json($city, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city = City::find($id);

         if ($city === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);

        if ($city === null) {
            return response()->json(['error' => 'Impossível realizar a remoção, o recurso solicitado não existe.'], 404);
        }

        $city->delete();

        return response()->json(['message' => 'A cidade foi removida com sucesso.'], 200);
    }
}
