@extends('plantilla/base')

@section('content')

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold mb-6">Crear nuevo usuario</h2> 

    <a href="{{ url('usuarios/create')}}" 
       class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 
              hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
              dark:focus:ring-blue-800 font-medium rounded-base text-sm px-4 py-2.5 
              text-center leading-5">
        Nuevo Usuario
    </a>

    <div class="grid md:grid-cols-2 md:gap-6">
        <div class="relative z-0 w-full mb-5 group">
        <table class="w-full text-sm text-left text-gray-700 mt-10 border-t border-gray-300">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Puesto</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Dirección</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">RFC</th>
                    <th scope="col" class="px-6 py-3">Numero de seguro social</th>
                    <th scope="col" class="px-6 py-3">Correo electrónico</th>
                    <th scope="col" class="px-6 py-3">Fecha de nacimiento</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="px-6 py-4">{{ $usuario->id_usuario }}</td>
                    <td class="px-6 py-4">{{ $usuario->puesto }}</td>
                    <td class="px-6 py-4">{{ $usuario->nombre_usuario }}</td>
                    <td class="px-6 py-4">{{ $usuario->direccion }}</td>
                    <td class="px-6 py-4">{{ $usuario->telefono }}</td>
                    <td class="px-6 py-4">{{ $usuario->rfc }}</td>
                    <td class="px-6 py-4">{{ $usuario->num_ss }}</td>
                    <td class="px-6 py-4">{{ $usuario->correo }}</td>
                    <td class="px-6 py-4">{{ $usuario->fecha_Nac }}</td>
                    <td class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <a href="{{ url('usuarios/' .$usuario->id_usuario.'/edit') }}">Editar </a></td>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
