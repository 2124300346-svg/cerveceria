<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cervecería - Login</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<main class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <div class="bg-white rounded-xl shadow-lg p-8">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Cervecería</h1>
                <p class="text-gray-500 mt-2">Inicia sesión para continuar</p>
            </div>

            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Usuario
                    </label>

                    <input
                        type="text"
                        name="correo"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                        placeholder="admin"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        name="contrasena"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                        placeholder="••••••••"
                        required>
                </div>

                <button
                    type="submit"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 rounded-lg transition">
                    Iniciar sesión
                </button>

            </form>

            <div class="flex items-center my-6">
                <hr class="flex-1 border-gray-300">
                <span class="px-3 text-gray-400 text-sm">o</span>
                <hr class="flex-1 border-gray-300">
            </div>

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

</body>
</html>