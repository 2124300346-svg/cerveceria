@extends('plantilla/base')

@section('content')

@php
    $puesto = session('puesto');
@endphp

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Nuevo pedido</h2> 

    <a href="{{ url('pedidos/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nuevo pedido
    </a>

        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Fecha Pedido</th>
                    <th scope="col" class="px-6 py-3">Fecha Pago</th>
                    <th scope="col" class="px-6 py-3">Nombre Cliente</th>
                    <th scope="col" class="px-6 py-3">Producto</th>
                    <th scope="col" class="px-6 py-3">Presentación</th>
                    <th scope="col" class="px-6 py-3">Estado Pedido</th>
                    <th scope="col" class="px-6 py-3">Monto</th>
                    @if(in_array($puesto, ['administrador', 'distribuidor']))
                        <th scope="col" class="px-6 py-3">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td class="px-6 py-4">{{ $pedido->id_pedido }}</td>
                    <td class="px-6 py-4">{{ $pedido->fecha_pedido }}</td>
                    <td class="px-6 py-4">{{ $pedido->fecha_pago }}</td>
                    <td class="px-6 py-4">{{ $pedido->nombre_cliente }}</td>
                    <td class="px-6 py-4">{{ $pedido->producto }}</td>
                    <td class="px-6 py-4">{{ $pedido->nombre_presentacion }}</td>
                    <td class="px-6 py-4">{{ $pedido->estado_pedido }}</td>
                    <td class="px-6 py-4">{{ $pedido->monto }}</td>
                    
                    @if(in_array($puesto, ['administrador', 'distribuidor']))
                    <td class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <a href="{{ url('pedidos/' . $pedido->id_pedido . '/edit') }}">Editar </a></td>
                    @endif

                    @if($puesto == 'administrador')
                        <td class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <form action="{{ url('pedidos/' . $pedido->id_pedido) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este pedido?');">
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