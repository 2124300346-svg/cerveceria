<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PresentacionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return auth('admin')->check()
        ? redirect('/dashboard')
        : redirect('/login');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resource('/clientes', ClienteController::class);
    Route::resource('/usuarios', UsuarioController::class);
    Route::resource('/presentaciones', PresentacionController::class);
    Route::resource('/productos', ProductoController::class);
    Route::resource('/pedidos', PedidoController::class);
    Route::resource('/administradores', AdministradorController::class);

    Route::post('/logout', [LoginController::class, 'logout']);
});