@extends('plantilla/base')

@section('content')

@php
    $puesto = session('puesto');
@endphp

@if($puesto == 'administrador')

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Crear nuevo cliente</h2> 

    <a href="{{ url('clientes/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nuevo Cliente
    </a>
@endif
    <div class="grid md:grid-cols-2 md:gap-6 ">
        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Estado</th>
                    <th scope="col" class="px-6 py-3">Dirección</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">RFC</th>
                    <th scope="col" class="px-6 py-3">Correo electrónico</th>
                    <th scope="col" class="px-6 py-3">Fecha de nacimiento</th>
                    <th scope="col" class="px-6 py-3">Numero de pedidos</th>
                    @if( $puesto == 'administrador')
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td class="px-6 py-4">{{ $cliente->id_cliente }}</td>
                    <td>
                    <img src="{{ asset($cliente->img_cliente)}}" width="80">
                    </td>
                    <td class="px-6 py-4">{{ $cliente->nombre_cliente }}</td>
                    <td class="px-6 py-4">{{ $cliente->estado}}</td>
                    <td class="px-6 py-4">{{ $cliente->direccion }}</td>
                    <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                    <td class="px-6 py-4">{{ $cliente->rfc }}</td>
                    <td class="px-6 py-4">{{ $cliente->correo }}</td>
                    <td class="px-6 py-4">{{ $cliente->fecha_Nac }}</td>
                    <td class="px-6 py-4">{{ $cliente->Num_pedidos }}</td>
                    @if($puesto =='administrador')
                    <td class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <a href="{{ url('clientes/' .$cliente->id_cliente.'/edit') }}">Editar </a></td>
                    </td>
                    <td class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <form action="{{ url('clientes/' .$cliente->id_cliente) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
