@extends('plantilla/base')

@section('content')
 <main>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Editar Producto</h2> 
        
        @if ($errors->any())

        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
            <svg class="w-4 h-4 me-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <span class="sr-only">Alerta</span>
            <div>
                <span class="font-medium">Revisa los campos</span>
                <ul class="mt-2 list-disc list-outside space-y-1 ps-2.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        @endif

            <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST" class="max-w-md mx-auto">
                @csrf
                @method('PUT')

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                        <label for="nombre" 
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Nombre del Producto</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="descripcion" id="descripcion" value="{{ $producto->descripcion }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                        <label for="descripcion" 
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Descripción</label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="file" name="img1_pr" id="img1_pr" value="{{ $producto->img1_pr }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer"/>
                        <label for="img1_pr"
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Imagen 1 Producto
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="file" name="img2_pr" id="img2_pr" value="{{ $producto->img2_pr }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer"/>
                        <label for="img2_pr"
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Imagen 2 Producto
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="file" name="img3_pr" id="img3_pr" value="{{ $producto->img3_pr }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer"/>
                        <label for="img3_pr"
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                        Imagen 3 Producto
                        </label>
                    </div>
                    <div>
                        <select name="estado" id="estado" value="{{ $producto->estado }}" 
                            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer">
                            <option value="Activo" {{ $producto->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                            <option value="Inactivo" {{ $producto->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>
                    <a href={{ url('productos') }} class="text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-base text-sm px-4 py-2.5 text-center mr-2 mb-2">Cancelar</a>
                    <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Guardar</button>
            </form>
     </div>
</main>
@endsection