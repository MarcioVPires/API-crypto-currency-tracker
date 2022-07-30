<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinsDataController;

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

Route::get('/coins', [CoinsDataController::class, 'coinslist']);
Route::get('/search-coins-name', [CoinsDataController::class, 'searchCoin']);
Route::get('/search-coins-date-time', [CoinsDataController::class, 'dateTimePriceSearch']);
Route::get('/get-current-price', [CoinsDataController::class, 'currentPrice']);
Route::get('/favorite', [CoinsDataController::class, 'favorite']);
Route::get('/populate', [CoinsDataController::class, 'populate']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
