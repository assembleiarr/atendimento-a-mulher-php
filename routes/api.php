<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtendimentosController;
use App\Http\Controllers\AssistidosController;



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

Route::get('/municipios/{estado_id}', [AtendimentosController::class, 'municipios']);
Route::get('/paises', [AtendimentosController::class, 'paises']);

Route::get('/assistido/{cpf}', [AssistidosController::class, 'api']);
Route::get('/assistido/pesquisa/{cpf_or_nome}', [AssistidosController::class, 'pesquisa']);



