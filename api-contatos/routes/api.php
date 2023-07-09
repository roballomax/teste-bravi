<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PessoaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PessoaController::class)->prefix('pessoa')->group(function() {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getOne');
    Route::post('/', 'add');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});

Route::controller(ContatoController::class)->prefix('contato')->group(function() {
    Route::get('/', 'getAll');
    Route::get('/{id}', 'getOne');
    Route::post('/', 'add');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'delete');
});