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
        
        <form action="{{ route('pedidos.store') }}" method="POST" class="max-w-md mx-auto">
        @csrf

        <div class="relative z-0 w-full mb-5 group">
        <select name="id_cliente" required 
            class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer">
            <option value="" disabled selected>Seleccionar cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id_cliente }}">
                    {{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}
                </option>
            @endforeach
        </select>
        </div>

        <div class="relative z-0 w-full mb-5 group">
        <input type="date" name="fecha_pedido" required 
        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium appearance-none focus:outline-none focus:ring-0 focus:border-brand peer">
        </div>

        <div class="relative z-0 w-full mb-5 group">
        <select name="estado" required 
        class="block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer">
            <option value="" disabled selected>Seleccionar estado</option>
            <option value="pendiente">Pendiente</option>
            <option value="pagado">Pagado</option>
        </select>
        </div>

        <div id="productosPedido" class="relative z-0 w-full mb-5 group">
        </div>

        <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group" id="productosPedido">
        <button type="button" onclick="agregarProducto()" class="bg-green-600 text-white px-4 py-2 rounded">+ Añadir producto</button>
        </div>
        <div class="relative z-0 w-full mb-5 group">
        <button type="submit" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 text-center leading-5">Agendar pedido</button>
        </div>
        </div>

</form>
</main>
<script>
    window.productosData = @json($productos);
</script>
@vite('resources/js/agregar.js')
@endsection