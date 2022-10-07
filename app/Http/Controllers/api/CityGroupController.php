<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityGroupResource;
use App\Http\Resources\CityGroupsCollection;
use App\Models\CityGroup;
use Illuminate\Http\Request;

class CityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CityGroupsCollection(CityGroup::all());
        // $cityGroups = CityGroup::with('cities', 'campaign')->get();

        // return response()->json($cityGroups, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cityGroup = new CityGroup;

        $request->validate($cityGroup->rules(), $cityGroup->feedback());

        return response()->json($cityGroup->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function show($cityGroup)
    {
        $cityGroup = CityGroup::with('cities', 'campaign')->find($cityGroup);

        if ($cityGroup) {
            return new CityGroupResource($cityGroup);
            // return response()->json($cityGroup, 200);
        }

        return response()->json([
            'error' => 'Grupo de cidades não encontrado.'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cityGroup)
    {
        $cityGroup = CityGroup::find($cityGroup);

        if ($cityGroup) {
            $request->validate($cityGroup->rules(), $cityGroup->feedback());

            $cityGroup->update($request->all());

            return response()->json($cityGroup, 200);
        }

        return response()->json(['error' => 'Impossível realizar a atualização, o grupo de cidades solicitado não existe.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CityGroup  $cityGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($cityGroup)
    {
        $cityGroup = CityGroup::find($cityGroup);

        if ($cityGroup) {
            $cityGroup->delete();

            return response()->json(['message' => 'O grupo de cidades foi removido com sucesso.'], 200);
        }

        return response()->json(['error' => 'Impossível realizar a remoção, o grupo de cidades solicitado não existe.'], 404);
    }
}
