@extends('plantilla/base')

@section('content')
 <main>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Crear nueva presentación</h2> 
        
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

            <form action="{{ route('presentaciones.store') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                <div class="relative z-0 w-full mb-5 group">
                    <select name="id_producto" id="id_producto" value="{{ old('id_producto') }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer">
                        <option value="" disabled selected>Seleccione el producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id_producto }}" 
                                {{ old('id_producto') == $producto->id_producto ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                    @endforeach
                    </select>
                </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="nombre_presentacion" id="nombre_presentacion" value="{{ old('nombre_presentacion') }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                        <label for="nombre_presentacion" 
                        class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Nombre de la Presentación</label>
                    </div>
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                    <select name="cantidad_unitaria" id="cantidad_unitaria" value="{{ old('cantidad_unitaria') }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer">
                        <option value="" disabled selected>Seleccione la cantidad unitaria</option>
                        <option value="12">12</option>
                        <option value="48">48</option>
                    </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="cantidad_caja" id="cantidad_caja"  maxlength="5" value="{{ old('cantidad_caja') }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                        <label for="cantidad_caja" class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Cantidad de cajas</label>
                    </div>
                </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="precio_unidad" id="precio_unidad" maxlength="10" value="{{ old('precio_unidad') }}"
                        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                        <label for="precio_unidad" class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                            Precio por unidad</label>
                    </div>
                    
                <div class="relative z-0 w-full mb-5 group">
                    <input type="number" name="precio_caja" id="precio_caja" maxlength="10" value="{{ old('precio_caja') }}"
                    class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer" placeholder=" " required />
                    <label for="precio_caja" class="absolute text-sm text-body duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-fg-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">
                        Precio por caja</label>
                </div>
                <a href={{ url('presentaciones') }} class="text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-base text-sm px-4 py-2.5 text-center mr-2 mb-2">Cancelar</a>
                <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Guardar</button>
            </form>
     </div>
</main>
@endsection