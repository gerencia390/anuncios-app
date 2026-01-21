<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AnuncioPropioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
----------------------------------------
* RUTAS: PÚBLICAS
----------------------------------------
*/
Route::get('/', function () {
    return view('publico.login', ['titulo'=>'Acceso al sistema']);
});

Route::get('/mail', function () {
    return view('intro', ['grado'=>2]);
});

/*
----------------------------------------
* RUTAS: AUTENTICACIÓN
----------------------------------------
*/
Route::get('/logout', [AuthController::class ,'logout']);
Route::post('/auth', [AuthController::class ,'autenticar']);
// Route::resource('/auth', AuthController::class);

/*
----------------------------------------
* RUTAS: DASHBOARD
----------------------------------------
*/
Route::resource('/dashboard', DashboardController::class);


/*
----------------------------------------
* RUTAS: ANUNCIOS CLASIFICADOS - DESTACADOS
----------------------------------------
*/
Route::get('/anuncios/letrero1', [AnuncioController::class ,'letrero1']);
Route::post('/anuncios/finalizar/{anu_id}', [AnuncioController::class ,'finalizar']);
Route::resource('/anuncios', AnuncioController::class);

/*
----------------------------------------
* RUTAS: ANUNCIOS PROPIOS
----------------------------------------
*/
Route::post('/anuncios_propios/finalizar/{anu_id}', [AnuncioPropioController::class ,'finalizar']);
Route::resource('/anuncios_propios', AnuncioPropioController::class);
/*
----------------------------------------
* RUTAS: USUARIOS
----------------------------------------
*/
Route::resource('/usuarios', UsuarioController::class);



/*
----------------------------------------
* RUTAS: REPORTES
----------------------------------------
*/
Route::resource('/reportes', ReporteController::class);

