<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:50',
        'descripcion' => 'required|string|max:255',
        'img1_pr' => 'required|image|max:2048',
        'img2_pr' => 'required|image|max:2048',
        'img3_pr' => 'required|image|max:2048',
    ]);

    $validated['img1_pr'] = '';
    $validated['img2_pr'] = '';
    $validated['img3_pr'] = '';

    $producto = Producto::create($validated);

    if ($request->hasFile('img1_pr')) {

        $archivo = $request->file('img1_pr');

        $nombre = 'producto_' . $producto->id_producto . '_1.' .
                  $archivo->getClientOriginalExtension();

        $archivo->move(public_path('imagenes/productos'), $nombre);

        $producto->img1_pr = 'imagenes/productos/' . $nombre;
    }

    if ($request->hasFile('img2_pr')) {

        $archivo = $request->file('img2_pr');

        $nombre = 'producto_' . $producto->id_producto . '_2.' .
                  $archivo->getClientOriginalExtension();

        $archivo->move(public_path('imagenes/productos'), $nombre);

        $producto->img2_pr = 'imagenes/productos/' . $nombre;
    }

    if ($request->hasFile('img3_pr')) {

        $archivo = $request->file('img3_pr');

        $nombre = 'producto_' . $producto->id_producto . '_3.' .
                  $archivo->getClientOriginalExtension();

        $archivo->move(public_path('imagenes/productos'), $nombre);

        $producto->img3_pr = 'imagenes/productos/' . $nombre;
    }

    $producto->save();

    return redirect()->route('productos.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_producto)
    {
        $producto = Producto::find($id_producto);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_producto)
    {
        $producto = Producto::findOrFail($id_producto);

        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'img1_pr' => 'nullable|image|max:2048',
            'img2_pr' => 'nullable|image|max:2048',
            'img3_pr' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('img1_pr')) {

            $archivo = $request->file('img1_pr');

            $nombre = 'producto_' . $producto->id_producto . '_1.' .
                    $archivo->getClientOriginalExtension();

            $archivo->move(public_path('imagenes/productos'), $nombre);

            $validated['img1_pr'] = 'imagenes/productos/' . $nombre;

        } else {

            $validated['img1_pr'] = $producto->img1_pr;
        }

        if ($request->hasFile('img2_pr')) {

            $archivo = $request->file('img2_pr');

            $nombre = 'producto_' . $producto->id_producto . '_2.' .
                    $archivo->getClientOriginalExtension();

            $archivo->move(public_path('imagenes/productos'), $nombre);

            $validated['img2_pr'] = 'imagenes/productos/' . $nombre;

        } else {

            $validated['img2_pr'] = $producto->img2_pr;
        }

        if ($request->hasFile('img3_pr')) {

            $archivo = $request->file('img3_pr');

            $nombre = 'producto_' . $producto->id_producto . '_3.' .
                    $archivo->getClientOriginalExtension();

            $archivo->move(public_path('imagenes/productos'), $nombre);

            $validated['img3_pr'] = 'imagenes/productos/' . $nombre;

        } else {

            $validated['img3_pr'] = $producto->img3_pr;
        }

        $producto->update($validated);

        return redirect()
        ->route('productos.index')
        ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->estado='inactivo';
        $producto->save();

        return redirect()
        ->route('productos.index')
        ->with('success', 'Producto eliminado exitosamente.');
    }
}
