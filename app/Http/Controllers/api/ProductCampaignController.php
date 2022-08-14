<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Product;
use App\Models\ProductCampaign;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductCampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsCampaigns = ProductCampaign::all();

        return response()->json($productsCampaigns, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productCampaign = new ProductCampaign;

        $request->validate($productCampaign->rules(), $productCampaign->feedback());

        if ($request->discount) {
            $productPrice = Product::findOrFail($request->product_id)->price;

            $response = $productCampaign->create([
                'product_id' => $request->product_id,
                'campaign_id'=> $request->campaign_id,
                'discount' => $request->discount,
                'price_with_discount' => $productPrice - $request->discount,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $response = $productCampaign->create($request->all());
        }

        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productCampaign = ProductCampaign::find($id);

        if ($productCampaign === null) {
            return response()->json(['error' => 'Recurso não encontrado.'], 404);
        }

        return response()->json($productCampaign, 200);
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
        $productCampaign = ProductCampaign::find($id);

        if ($productCampaign === null) {
            return response()->json(['error' => 'Impossível realizar a atualização, o recurso solicitado não existe.'], 404);
        }

        if ($request->discount) {
            $product_id = $productCampaign->product_id;
            $productPrice = Product::findOrFail($product_id)->price;

            $productCampaign->update([
                'discount' => $request->discount,
                'price_with_discount' => $productPrice - $request->discount,
                'updated_at' => Carbon::now(),
            ]);
        } else {
            return response()->json(['error' => 'Impossível realizar a atualização, informe o novo desconto.'], 422);
        }

        return response()->json($productCampaign, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productCampaign = ProductCampaign::find($id);

        if ($productCampaign === null) {
            return response()->json(['error' => 'Impossível realizar a remoção, o recurso solicitado não existe.'], 404);
        }

        $productCampaign->delete();

        return response()->json(['message' => 'Exclusão realizada com sucesso.'], 200);
    }
}
