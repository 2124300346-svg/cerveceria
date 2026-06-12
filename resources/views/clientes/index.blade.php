@extends('plantilla/base')

@section('content')

    <h2>Listado de clientes</h2>

    <a href="{{ url('clientes/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nuevo Cliente
    </a>

    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Dirección</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">RFC</th>
                    <th scope="col" class="px-6 py-3">Correo electrónico</th>
                    <th scope="col" class="px-6 py-3">Fecha de nacimiento</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                    <td class="px-6 py-4">{{ $cliente->id_cliente }}</td>
                    <td class="px-6 py-4">{{ $cliente->nombre_cliente }}</td>
                    <td class="px-6 py-4">{{ $cliente->direccion }}</td>
                    <td class="px-6 py-4">{{ $cliente->telefono }}</td>
                    <td class="px-6 py-4">{{ $cliente->rfc }}</td>
                    <td class="px-6 py-4">{{ $cliente->correo }}</td>
                    <td class="px-6 py-4">{{ $cliente->fecha_Nac }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ url('clientes/'.$cliente->id_cliente.'/edit') }}" 
                           class="text-blue-600 hover:text-blue-900">Editar</a>

                        <form action="{{ url('clientes/'.$cliente->id_cliente) }}" 
                              method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900" 
                                    onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
