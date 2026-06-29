<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'contrasena' => 'required'
        ]);

        $user = Usuario::where('correo', $request->correo)->first();

        if (!$user) {
            return back()->withErrors(['correo' => 'Usuario no encontrado']);
        }

        if ($user->estado !== 'activo') {
            return back()->withErrors(['correo' => 'Usuario inactivo']);
        }

        if ($user->contrasena !== $request->contrasena) {
            return back()->withErrors(['contrasena' => 'Contraseña incorrecta']);
        }

        session([
            'user_id' => $user->id_usuario,
            'nombre' => $user->nombre_usuario,
            'correo' => $user->correo,
            'puesto' => $user->puesto,
            'img' => $user->img1_usu,
            'auth_type' => 'local'
        ]);

        return redirect ('/dashboard');
    }
    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = Usuario::where('correo', $githubUser->getEmail())->first();

        if (!$user) {
            $user = Usuario::create([
                'nombre_usuario' => $githubUser->getNickname() ?? $githubUser->getName(),
                'correo' => $githubUser->getEmail(),
                'contrasena' => '',
                'estado' => 'activo',
                'puesto' => 'usuario',
                'img1_usu' => $githubUser->getAvatar()
            ]);
        }

        if ($user->estado !== 'activo') {
            return redirect('/login');
        }

        session([
            'user_id' => $user->id_usuario,
            'nombre' => $user->nombre_usuario,
            'puesto' => $user->puesto,
            'img' => $user->img1_usu,
            'auth_type' => 'github'
        ]);

        switch ($user->puesto) {
            case 'administrador':
                return redirect('/dashboard');

            case 'distribuidor':
                return redirect('/dashboard');

            default:
                return redirect('/dashboard');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}