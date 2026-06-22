<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'contrasena' => 'required'
        ]);

        $credentials = [
            'usuario' => $request->usuario,
            'password' => $request->contrasena
        ];

        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();

            if (!$admin || !$admin->activo) {
                Auth::guard('admin')->logout();

                return back()->withErrors([
                    'login' => 'Usuario desactivado'
                ]);
            }

            return redirect('/dashboard');
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'login' => 'Usuario o contraseña incorrectos'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}