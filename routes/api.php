<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

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

Route::post('/inventario/lectura_entrega', [InventarioController::class ,'lectura_entrega']);
Route::post('/inventario/lectura_almacen', [InventarioController::class ,'lectura_almacen']);
Route::get('/inventario/lectura_almacen', [InventarioController::class ,'lectura_almacen2']);
