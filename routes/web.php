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
use App\Http\Controllers\SocialiteController;

Route::get('/test-config', function () {
    dd(config('services.github'));
});

Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/redirection/{provider}', 'authProviderRedirect')->name('auth.redirection');
    Route::get('auth/{provider}/callback', 'socialAuthentication')->name('auth.callback');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (!session()->has('user_id')) return redirect('/login');
    return app(DashboardController::class)->index();
});

Route::get('/clientes', function () {
    if (!session()->has('user_id')) return redirect('/login');
    return app(ClienteController::class)->index();
});

Route::resource('/usuarios', UsuarioController::class);
Route::resource('/presentaciones', PresentacionController::class);
Route::resource('/productos', ProductoController::class);
Route::resource('/pedidos', PedidoController::class);
Route::resource('/administradores', AdministradorController::class);