<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoSangreController;
use App\Http\Controllers\TipoClienteController;
use App\Http\Controllers\ColocacionController;
use App\Http\Controllers\ArticuloColocacionController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\Py1Controller;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AuthController;

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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clientes', ClienteController::class);
    Route::apiResource('tipoSangre', TipoSangreController::class);
    Route::apiResource('tipoCliente', TipoClienteController::class);
    Route::apiResource('colocacion', ColocacionController::class);
    Route::apiResource('articuloColocacion', ArticuloColocacionController::class);
    Route::apiResource('articulo', ArticuloController::class);
    Route::apiResource('py1', Py1Controller::class);
    Route::apiResource('factura', FacturaController::class);
    Route::apiResource('pedido', PedidoController::class);


    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});