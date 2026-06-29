<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cerveceria</title>
</head>

<body>

@vite('resources/css/app.css')
@vite('resources/js/app.js')

@php
    $puesto = session('puesto');
@endphp

@if(session()->has('user_id'))

<nav class="bg-neutral-primary border-default">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">

        <a href="/" class="flex items-center space-x-3">
            <img src="{{ asset('imagenes/logo_grupo_modelo_2.png') }}" class="h-7" alt="Logo" />
            <span class="self-center text-xl font-semibold">Grupo modelo</span>
        </a>

        <button data-collapse-toggle="mega-menu" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm md:hidden">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
            </svg>
        </button>

        <div id="mega-menu" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">

            <ul class="flex flex-col mt-4 md:flex-row md:mt-0 md:space-x-8">

                <li><a href="/clientes">Clientes</a></li>

                @if($puesto == 'administrador')
                    <li><a href="/usuarios">Usuarios</a></li>
                    <li><a href="/presentaciones">Presentaciones</a></li>
                @endif

                @if(in_array($puesto, ['administrador','distribuidor']))
                    <li><a href="/productos">Productos</a></li>
                @endif

                <li><a href="/pedidos">Pedidos</a></li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-white bg-red-600 px-4 py-2 rounded">
                            Cerrar sesión
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="bg-neutral-secundary-soft border-b shadow-sm">
    <div class="max-w-screen-xl mx-auto px-4 py-4 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">

        <div class="bg-white border rounded-2xl p-4">
            <p class="text-xs uppercase">Ubicación</p>
            <p id="ciudad">Cargando...</p>
            <p id="estado">Cargando...</p>
            <p id="pais">Cargando...</p>
        </div>

        <div class="bg-white border rounded-2xl p-4">
            <p class="text-xs uppercase">Clima</p>
            <p id="temperatura">Cargando...</p>
            <p id="humedad">Cargando...</p>
            <p id="lluvia">Cargando...</p>
        </div>

        <div class="bg-white border rounded-2xl p-4">
            <p class="text-xs uppercase">Peso a Dólar</p>
            <p id="dolar" class="text-2xl font-semibold">Cargando...</p>
        </div>

    </div>
</div>

@endif

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
async function cargarInformacion(){

    try {

        navigator.geolocation.getCurrentPosition(async function(position){

            let lat = position.coords.latitude;
            let lon = position.coords.longitude;

            let geo = await fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json`);
            let geoData = await geo.json();

            document.getElementById('ciudad').innerHTML = geoData.address.city || geoData.address.town || 'No disponible';
            document.getElementById('estado').innerHTML = geoData.address.state;
            document.getElementById('pais').innerHTML = geoData.address.country;

            let clima = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=34445d6d99f24a29509d1ef40e50eae5&units=metric&lang=es`);
            let climaData = await clima.json();

            document.getElementById('temperatura').innerHTML = climaData.main.temp + " °C";
            document.getElementById('humedad').innerHTML = climaData.main.humidity + "%";
            document.getElementById('lluvia').innerHTML = climaData.weather[0].description;

        });

        let cambio = await fetch('https://open.er-api.com/v6/latest/USD');
        let data = await cambio.json();

        document.getElementById('dolar').innerHTML = "1 USD = " + data.rates.MXN.toFixed(2) + " MXN";

    } catch(e){
        console.log(e);
    }
}

cargarInformacion();
</script>

</body>
<footer class="text-center p-4">
    &copy; 2024 Grupo Modelo. Todos los derechos reservados.
</footer>
</html>