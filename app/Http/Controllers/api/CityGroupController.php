<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        $cityGroups = CityGroup::with('cities', 'campaign')->get();

        return response()->json($cityGroups, 200);
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

        return response()->json($cityGroup->create($request->all()),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cityGroup = CityGroup::with('cities', 'campaign')->find($id);

        if ($cityGroup === null) {
            return response()->json(['error' => 'Grupo não encontrado.'], 404);
        }

        return response()->json($cityGroup, 200);
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
        $cityGroup = CityGroup::find($id);

        if ($cityGroup === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        $request->validate($cityGroup->rules(), $cityGroup->feedback());

        $cityGroup->update($request->all());

        return response()->json($cityGroup, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cityGroup = CityGroup::find($id);

        if ($cityGroup === null) {
            return response()->json(['error' => 'Impossível realizar a remoção, o recurso solicitado não existe.'], 404);
        }

        $cityGroup->delete();

        return response()->json(['message' => 'O grupo de cidades foi removido com sucesso.'], 200);
    }
}
