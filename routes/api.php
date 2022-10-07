<?php

use App\Http\Controllers\api\CampaignController;
use App\Http\Controllers\api\CityController;
use App\Http\Controllers\api\CityGroupController;
use App\Http\Controllers\api\ProductCampaignController;
use App\Http\Controllers\api\ProductController;
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

Route::apiResources([
    'cities' => CityController::class,
    'city-groups' => CityGroupController::class,
    'campaigns' => CampaignController::class,
    'products' => ProductController::class,
    'products-campaigns' => ProductCampaignController::class,
]);
