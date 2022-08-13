<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();

        return response()->json($campaigns, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = new Campaign;

        $request->validate($campaign->rules());

        return response()->json($campaign->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::findOrFail($id);

        return response()->json($campaign, 200);
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
        $campaign = new Campaign;

        $request->validate($campaign->rules());

        $campaign->find($id);

        if ($campaign === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        $campaign->update($request->all());

        return response()->json($campaign, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campaign = Campaign::find($id);

        if ($campaign === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        $campaign->delete();

        return response()->json(['message' => 'A campanha foi removida com sucesso.'], 200);
    }
}
