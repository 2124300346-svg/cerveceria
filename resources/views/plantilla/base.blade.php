<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cerveceria</title>

<body>

 @vite('resources/css/app.css')
 @vite('resources/js/app.js')

    <nav class="bg-neutral-primary border-default">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('imagenes/logo_grupo_modelo_2.png') }}" class="h-7" alt="Logo Grupo Modelo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap text-heading">Grupo modelo</span>
            </a>
            <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                <a href="#"
                    class="text-heading bg-neutral-primary box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary-soft font-medium leading-5 rounded-base text-sm px-3 py-2 focus:outline-none">Login</a>
                <a href="#"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5">Sign
                    Up</a>
                <button data-collapse-toggle="mega-menu" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-lg md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-default"
                    aria-controls="mega-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div>
            <div id="mega-menu" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                    <li>
                        <a href="/clientes"
                            class="block py-2 px-3 text-fg-brand border-b border-light hover:bg-neutral-secondary-soft md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0"
                            aria-current="page">Clientes</a>
                    </li>
                       <li>
                        <a href="/usuarios"
                            class="block py-2 px-3 text-heading border-b border-light hover:bg-neutral-secondary-soft md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">Usuarios</a>
                    </li>
                 
                        <a href="/presentaciones"
                            class="block py-2 px-3 text-heading border-b border-light hover:bg-neutral-secondary-soft md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">Presentaciones</a>
                    </li>
                    <li>
                        <a href="/productos"
                            class="block py-2 px-3 text-heading border-b border-light hover:bg-neutral-secondary-soft md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">Producto</a>
                    </li>
                      <li>
                        <a href="/pedidos"
                            class="block py-2 px-3 text-heading border-b border-light hover:bg-neutral-secondary-soft md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0">
                            Pedidos
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="bg-neutral-secondary-soft py-4">
        <div class="max-w-screen-xl mx-auto px-4">

            <div>
                <h3 class="font-bold text-blue-800">Ubicacion</h3>
                <p id="ciudad">Ciudad: Cargando...</p>
                <p id="estado">Estado: Cargando...</p>
                <p id="pais">País: Cargando...</p>
            </div>
            

            <div>
                <h3 class="font-bold text-blue-800">Clima</h3>
                <p id="temperatura">Temperatura: Cargando...</p>
                <p id="humedad">Humedad: Cargando...</p>
                <p id="lluvia">Condicion: Cargando...</p>
            </div>

            <div>
                <h3 class="font-bold text-yellow-800">Tipo de cambio</h3>
                <p id=dolar>1 USD = Cargando...</p>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <footer class="bg-navy text-center text-black p-4">
        &copy; 2024 Grupo Modelo. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        async function cargarInformacion(){
            try {
                navigator.geolocation.getCurrentPosition(async function(position){

                    let lat = position.coords.latitude;
                    let lon = position.coords.longitude;

                    console.log("Lat: ", lat);
                    console.log("Lon: ", lon);

                    let geoResponse =await fetch(
                        `http://api.positionstack.com/v1/reverse?access_key=a391f77472ed58b67d5c3289874986cd&query=${lat},${lon}`
                    );

                    let geoData = await geoResponse.json();
                    let lugar = geoData.data[0];
                    console.log(lugar);

                    document.getElementById('ciudad').innerHTML=
                    'Ciudad: ' + (lugar.locality||lugar.label||lugar.country||'No disponible');

                    document.getElementById('estado').innerHTML=
                    'Estado: ' + lugar.region;

                    document.getElementById('pais').innerHTML=
                    'País: ' + lugar.country;

                    let climaResponse = await fetch(
                        `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=34445d6d99f24a29509d1ef40e50eae5&units=metric&lang=es`
                    );

                    let clima = await climaResponse.json();

                    document.getElementById('temperatura').innerHTML =
                    "Temperatura: " + clima.main.temp + " °C";

                    document.getElementById('humedad').innerHTML =
                    "Humedad: " + clima.main.humidity + "%";

                    document.getElementById('lluvia').innerHTML =
                    "Condicion " + clima.weather[0].description;
                });

                let cambioResponse = await fetch(
                    'https://open.er-api.com/v6/latest/USD'
                );

                let cambio = await cambioResponse.json();

                document.getElementById('dolar').innerHTML =
                "1 USD = "+ cambio.rates.MXN.toFixed(2)+"MXN";
            }
            catch(error){
                console.log(error);
            }
        }
        cargarInformacion();
    </script>
</body>
</html>