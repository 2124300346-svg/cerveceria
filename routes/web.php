<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/clientes', ClienteController::class);
Route::resource('/usuarios', UsuarioController::class);
Route::resource('/presentaciones', PresentacionController::class);
Route::resource('/productos', ProductoController::class);
