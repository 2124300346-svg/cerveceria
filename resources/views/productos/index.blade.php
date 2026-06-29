@extends('plantilla/base')

@section('content')
@php
    $puesto = session('puesto');
@endphp

@if($puesto == 'administrador')
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Crear nuevo producto</h2> 

    <a href="{{ url('productos/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nuevo Producto
    </a>
@endif

        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py3">Imagen 1</th>
                    <th scope="col" class="px-6 py3">Imagen 2</th>
                    <th scope="col" class="px-6 py3">Imagen 3</th>
                    <th scope="col" class="px-6 py-3">Producto</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                    @if($puesto=='administrador')
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td class="px-6 py-4">{{ $producto->id_producto }}</td>
                    <td>
                        <img src="{{ asset($producto->img1_pr)}}" width="80">
                    </td>
                    <td>
                        <img src="{{ asset($producto->img2_pr)}}" width="80">
                    </td>
                    <td>
                        <img src="{{ asset($producto->img3_pr)}}" width="80">
                    </td>
                    <td class="px-6 py-4">{{ $producto->nombre }}</td>
                    <td class="px-6 py-4">{{ $producto->descripcion }}</td>
                    <td class="px-6 py-4">{{ $producto->estado }}</td>
                    @if( $puesto == 'administrador')
                        <td class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center justify-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <a href="{{ url('productos/' . $producto->id_producto . '/edit') }}">Editar </a></td>
                        <td class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center justify-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <form action="{{ url('productos/' . $producto->id_producto) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
