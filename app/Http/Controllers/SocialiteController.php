<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function authProviderRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialAuthentication($provider)
    {
        $socialUser = Socialite::driver($provider)
            ->stateless()
            ->user();

        $user = Usuario::where('correo', $socialUser->getEmail())->first();

        if (!$user) {
            $user = Usuario::create([
                'nombre_usuario' => $socialUser->getName() ?? $socialUser->getNickname(),
                'correo' => $socialUser->getEmail(),
                'contrasena' => '',
                'estado' => 'activo',
                'puesto' => 'usuario',
                'img1_usu' => $socialUser->getAvatar()
            ]);
        }

        if ($user->estado !== 'activo') {
            return redirect('/login');
        }

        session([
            'user_id' => $user->id_usuario,
            'nombre' => $user->nombre_usuario,
            'correo' => $user->correo,
            'puesto' => $user->puesto,
            'img' => $user->img1_usu,
            'auth_type' => $provider
        ]);

        return match ($user->puesto) {
            'administrador' => redirect('/dashboard'),
            'distribuidor' => redirect('/dashboard'),
            'usuario' => redirect('/dashboard'),
        };
    }
}