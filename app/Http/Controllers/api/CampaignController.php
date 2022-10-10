<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\CampaignsCollection;
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
        return new CampaignsCollection(Campaign::all());
        // $campaigns = Campaign::with('products')->get();

        // return response()->json($campaigns, 200);
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

        $request->validate($campaign->rules(), $campaign->feedback());

        return response()->json($campaign->create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show($campaign)
    {
        $campaign = Campaign::with('products')->find($campaign);

        if ($campaign) {
            return new CampaignResource($campaign);
            // return response()->json($campaign, 200);
        }

        return response()->json(['error' => 'Campanha não encontrada.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $campaign)
    {
        $campaign = Campaign::find($campaign);

        if ($campaign) {
            $campaign->update($request->all());

            return response()->json($campaign, 200);
        }

        return response()->json(['error' => 'Impossível realizar a atualização, a campanha solicitada não existe.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy($campaign)
    {
        $campaign = Campaign::find($campaign);

        if ($campaign) {
            $campaign->delete();

            return response()->json(['message' => 'A campanha foi removida com sucesso.'], 200);
        }

        return response()->json(['error' => 'Impossível realizar a remoção, a campanha solicitada não existe.'], 404);
    }
}
