<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Support\Facades\Auth;
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

        $admin = Administrador::where('usuario', $socialUser->nickname)->first();

        if (!$admin) {
            $admin = Administrador::create([
                'nombre' => $socialUser->name ?? $socialUser->nickname,
                'usuario' => $socialUser->email,
                'contraseña' => Hash::make('Password1234'),
                'activo' => 1,
            ]);
        }

        Auth::login($admin);

        return redirect('/dashboard');
    }
}