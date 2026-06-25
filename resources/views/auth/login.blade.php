@extends('plantilla/base')

@section('content')

<main class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="w-full max-w-md">

        <div class="bg-white rounded-xl shadow-lg p-8">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Cervecería</h1>
                <p class="text-gray-500 mt-2">Inicia sesión para continuar</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario
                    </label>

                    <input
                        type="text"
                        name="usuario"
                        class="w-full px-4 py-3 border rounded-lg"
                        placeholder="admin"
                        required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="contrasena"
                        class="w-full px-4 py-3 border rounded-lg"
                        placeholder="••••••••"
                        required>
                </div>

                <button
                    type="submit"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 rounded-lg transition mb-4">

                    Iniciar sesión
                </button>

            </form>

            <!-- Divider -->
            <div class="flex items-center my-4">
                <hr class="flex-1 border-gray-300">
                <span class="px-3 text-gray-400 text-sm">o</span>
                <hr class="flex-1 border-gray-300">
            </div>

            <!-- GitHub Login -->
            <a
                href="{{ route('auth.redirection', 'github') }}"
                class="flex items-center justify-center gap-3 w-full border border-gray-300 rounded-lg py-3 hover:bg-gray-50 transition">

                <img src="{{ asset('imagenes/github.svg') }}" class="w-6 h-6" alt="GitHub">

                <span class="font-medium text-gray-700">
                    Iniciar sesión con GitHub
                </span>

            </a>

        </div>

    </div>
</main>

@endsection