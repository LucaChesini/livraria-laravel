<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\LivrosController;
use App\Http\Controllers\VendasController;
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

Route::post('/teste', function () {
    dd('teste');
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/clientes', [ClientesController::class, 'show']);
Route::post('/clientes', [ClientesController::class, 'store']);
Route::get('/clientes/busca', [ClientesController::class, 'buscaClientes']);

Route::get('/livros', [LivrosController::class, 'show']);
Route::get('/livros/busca', [LivrosController::class, 'buscaLivro']);

Route::get('/vendas', [VendasController::class, 'show']);
Route::get('/vendas/busca', [VendasController::class, 'buscaVenda']);
Route::post('/vendas', [VendasController::class, 'store']);