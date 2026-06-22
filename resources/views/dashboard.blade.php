@extends('/plantilla/base')

@section('content')
<p>
    Bienvenido, {{ $administrador->nombre }}
</p>

   <section class="bg-white light:bg-gray-900">
    <div class="flex justify-center items-center my-8">
    <img src="{{ asset('imagenes/logo_grupo_modelo_2.png') }}" class="h-20 w-auto" alt="Logo Grupo Modelo" />
    </div>
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl light:text-black">En grupo modelo</h1>
        <p class="mb-8 text-lg font-normal text--500 lg:text-xl sm:px-16 xl:px-48 light:text-white-400">Formamos parte de AB InBev, la cervecera más grande del mundo, lo que le permite expandir su alcance internacional y seguir innovando en el mercado. Su misión es clara: crear experiencias únicas que unan a las personas y celebren la vida.</p>
        <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
            <a href="/productos" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-black rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                Mira nuestros productos
                <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <button type="button" class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Default</button>
            </a>
        </div>
    </div>
</section>

@endsection