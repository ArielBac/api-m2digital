<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductsCollection(Product::all());
        // $products = Product::with('campaigns')->get();

        // return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        $product = Product::with('campaigns')->find($product);

        if ($product) {
            return new ProductResource($product);
            // return response()->json($product, 200);
        }

        return response()->json(['error' => 'Produto não encontrada.'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        $product = Product::find($product);

        if ($product) {
            $product->update($request->all());

            return response()->json($product, 200);
        }

        return response()->json(['error' => 'Impossível realizar a atualização, o produto solicitado não existe.'], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $product = Product::find($product);

        if ($product) {
            $product->delete();

            return response()->json(['message' => 'O produto foi removida com sucesso.'], 200);
        }

        return response()->json(['error' => 'Impossível realizar a remoção, o produto solicitado não existe.'], 404);
    }
}
