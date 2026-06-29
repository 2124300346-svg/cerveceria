<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect('/login');
        }

        $usuario = [
            'id' => session('user_id'),
            'nombre' => session('nombre'),
            'correo' => session('correo'),
            'puesto' => session('puesto'),
            'img' => session('img'),
        ];

        return view('dashboard', compact('usuario'));
    }
}