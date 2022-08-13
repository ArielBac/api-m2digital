<?php

use App\Http\Controllers\api\CampaignController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\CityGroupController;
use App\Http\Controllers\api\ProductController;
use App\Models\ProductCampaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// City Routes
Route::apiResource('cities', CityController::class);

// CityGroup Routes
Route::apiResource('city-groups', CityGroupController::class);

// Campaign Routes
Route::apiResource('campaigns', CampaignController::class);

// Product Routes
Route::apiResource('products', ProductController::class);

// ProductCampaign Routes
Route::apiResource('products-campaigns', ProductCampaign::class);


