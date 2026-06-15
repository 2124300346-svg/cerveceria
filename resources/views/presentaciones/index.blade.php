@extends('plantilla/base')

@section('content')

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Crear nueva presentación</h2> 

    <a href="{{ url('presentaciones/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nueva Presentación
    </a>

    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Presentación</th>
                    <th scope="col" class="px-6 py-3">Cantidad Unitaria</th>
                    <th scope="col" class="px-6 py-3">Cantidad de cajas</th>
                    <th scope="col" class="px-6 py-3">Precio Unitario</th>
                    <th scope="col" class="px-6 py-3">Precio Por caja</th>
                    <th scope="col" class="px-6 py-3">Producto</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presentaciones as $presentacion)
                <tr>
                    <td class="px-6 py-4">{{ $presentacion->id_presentacion }}</td>
                    <td class="px-6 py-4">{{ $presentacion->nombre_presentacion }}</td>
                    <td class="px-6 py-4">{{ $presentacion->cantidad_unitaria }}</td>
                    <td class="px-6 py-4">{{ $presentacion->cantidad_caja }}</td>
                    <td class="px-6 py-4">{{ $presentacion->precio_unidad }}</td>
                    <td class="px-6 py-4">{{ $presentacion->precio_caja }}</td>
                    <td class="px-6 py-4">{{ $presentacion->nombre_producto }}</td>
                    <td class="px-6 py-4">{{ $presentacion->descripcion }}</td>
                    <td class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <a href="{{ url('presentaciones/' . $presentacion->id_presentacion . '/edit') }}">Editar </a>
                    </td>
                    <td class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <form action="{{ url('presentaciones/' . $presentacion->id_presentacion) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta presentación?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
