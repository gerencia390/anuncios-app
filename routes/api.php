<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AnuncioPropioController;

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

Route::post('/anuncios/existe_codigo', [AnuncioPropioController::class ,'existe_codigo']);
Route::post('/anuncios/ajustar_vencimientos', [AnuncioController::class ,'ajustar_vencimientos']);
Route::post('/anuncios/depurar', [AnuncioController::class ,'depurar']);
