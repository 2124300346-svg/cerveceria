<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/clientes', ClienteController::class);
Route::resource('/usuarios', UsuarioController::class);
