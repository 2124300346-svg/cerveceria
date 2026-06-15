@extends('plantilla/base')

@section('content')

<div class="container mx-auto px-4 py-8">

    <h2 class="text-2xl font-semibold mb-6">
        Pedido #{{ $pedido->id_pedido }}
    </h2>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6 mb-6">

        <div class="grid md:grid-cols-2 gap-4">

            <div>
                <strong>Cliente:</strong><br>
                {{ $pedido->cliente->nombre_cliente }}
                {{ $pedido->cliente->apellido_cliente }}
            </div>

            <div>
                <strong>Fecha Pedido:</strong><br>
                {{ $pedido->fecha_pedido }}
            </div>

            <div>
                <strong>Fecha Pago:</strong><br>
                {{ $pedido->fecha_pago ?? 'Sin pago registrado' }}
            </div>

            <div>
                <strong>Estado Actual:</strong><br>
                {{ ucfirst($pedido->estado) }}
            </div>

        </div>

    </div>

    <div class="bg-white shadow rounded-lg p-6">

        <h3 class="text-xl font-semibold mb-4">
            Productos del pedido
        </h3>

        <table class="w-full text-sm text-left text-gray-700 border">

            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3">Producto</th>
                    <th class="px-6 py-3">Presentación</th>
                    <th class="px-6 py-3">Precio Caja</th>
                    <th class="px-6 py-3">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                @foreach($detalles as $detalle)

                <tr class="border-t">

                    <td class="px-6 py-4">
                        {{ $detalle->producto->nombre }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $detalle->presentacion->nombre_presentacion }}
                    </td>

                    <td class="px-6 py-4">
                        ${{ number_format($detalle->presentacion->precio_caja,2) }}
                    </td>

                    <td class="px-6 py-4">
                        ${{ number_format($detalle->monto,2) }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

        <div class="mt-6 text-right">
            <h3 class="text-2xl font-bold">
                Total: ${{ number_format($total,2) }}
            </h3>
        </div>

    </div>

    <form
        action="{{ route('pedidos.update', $pedido->id_pedido) }}"
        method="POST"
        class="mt-6"
    >
        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2 font-medium">
                Estado del pedido
            </label>

            <select
                name="estado"
                class="border rounded px-4 py-2 w-full"
            >
                <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>
                    Pendiente
                </option>

                <option value="pagado" {{ $pedido->estado == 'pagado' ? 'selected' : '' }}>
                    Pagado
                </option>

                <option value="enviado" {{ $pedido->estado == 'enviado' ? 'selected' : '' }}>
                    Enviado
                </option>

                <option value="entregado" {{ $pedido->estado == 'entregado' ? 'selected' : '' }}>
                    Entregado
                </option>

                <option value="cancelado" {{ $pedido->estado == 'cancelado' ? 'selected' : '' }}>
                    Cancelado
                </option>

            </select>

        </div>

        <button
            type="submit"
            class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5"
        >
            Actualizar Estado
        </button>

    </form>

</div>

@endsection