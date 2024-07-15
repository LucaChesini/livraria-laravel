<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/clientes', function () {
    return view('clientes.list');
})->name('clientes.index');

Route::get('/clientes/criar', function () {
    return view('clientes.create');
})->name('clientes.create');

Route::get('/vendas', function () {
    return view('vendas.list');
})->name('vendas.index');

Route::get('/vendas/criar', function () {
    return view('vendas.create');
})->name('vendas.create');