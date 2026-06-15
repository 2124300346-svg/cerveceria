<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\DetallePedido;
use App\Models\Presentacion;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos=\DB::table('vista_pedidos_completo')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::with('presentaciones')->get();
        return view('pedidos.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'fecha_pedido' => 'required|date',
            'estado' => 'required|string',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:producto,id_producto',
            'productos.*.id_presentacion' => 'required|exists:presentacion,id_presentacion',
            'productos.*.cantidad_caja' => 'required',
        ]);

        foreach ($data['productos'] as $prod) {

        $presentacion = Presentacion::find($prod['id_presentacion']);

        if ($presentacion->cantidad_caja < $prod['cantidad_caja']) {

            return back()
                ->withInput()
                ->withErrors([
                    'stock' => 'No hay suficientes existencias de "' .
                    $presentacion->nombre_presentacion .
                    '". Disponibles: ' . $presentacion->cantidad_caja .
                    ' cajas.'
                ]);
        }
    }

        $pedido = Pedido::create([
            'id_cliente' => $data['id_cliente'],
            'fecha_pedido' => $data['fecha_pedido'],
            'estado' => $data['estado'],
            'fecha_pago' => $data['estado'] === 'pagado'
             ? now()
             : null,
        ]);

        foreach ($data['productos'] as $prod) {

    $presentacion = Presentacion::find($prod['id_presentacion']);

    DetallePedido::create([
        'id_pedido' => $pedido->id_pedido,
        'id_producto' => $prod['id_producto'],
        'id_presentacion' => $prod['id_presentacion'],

        'cantidad' =>
            $prod['cantidad_caja']
            * $presentacion->cantidad_unitaria,

        'monto' =>
            $prod['cantidad_caja']
            * $presentacion->precio_caja,
    ]);

     $presentacion->decrement('cantidad_caja', $prod['cantidad_caja']);

        }

        return redirect()->route('pedidos.index')->with('success', 'Pedido creado exitosamente.');
    }   
  

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        $detalles = DetallePedido::where('id_pedido', $pedido->id_pedido)
            ->with('producto', 'presentacion')
            ->get();

            $total = $detalles->sum('monto');

        return view('pedidos.edit', compact('pedido', 'detalles', 'total'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required'
        ]);

        $pedido->estado = $request->estado;

        if ($request->estado === 'pagado' && !$pedido->fecha_pago) {
            $pedido->fecha_pago = now();
        }

        $pedido->save();

        return redirect()
            ->route('pedidos.index')
            ->with('success', 'Estado actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
    $detalles = DetallePedido::where(
        'id_pedido',
        $pedido->id_pedido
    )->get();

    foreach ($detalles as $detalle) {

        $presentacion = Presentacion::find(
            $detalle->id_presentacion
        );

        $presentacion->increment(
            'cantidad_caja',
            $detalle->cantidad / $presentacion->cantidad_unitaria
        );

        $detalle->delete();
    }

    $pedido->delete();

    return redirect()
        ->route('pedidos.index')
        ->with('success', 'Pedido eliminado correctamente.');
    }
}
