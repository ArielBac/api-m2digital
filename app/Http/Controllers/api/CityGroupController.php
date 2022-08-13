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
        $city_groups = CityGroup::with('cities', 'campaign')->get();

        return response()->json($city_groups, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city_group = new CityGroup;

        $request->validate($city_group->rules());

        return response()->json($city_group->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city_group = CityGroup::with('cities', 'campaign')->findOrFail($id);

        return response()->json($city_group, 200);
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
        $city_group = new CityGroup;

        $request->validate($city_group->rules());

        $city_group->find($id);

        if ($city_group === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        $city_group->update($request->all());

        return response()->json($city_group, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city_group = CityGroup::find($id);

        if ($city_group === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        $city_group->delete();

        return response()->json(['message' => 'O grupo de cidades foi removida com sucesso.'], 200);
    }
}
