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
        $validated=$request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255'
            
        ]);

        if($request->hasFile('img1_pr')) {
            $validated['img1_pr'] = $request->file('img1_pr')->store('productos', 'public');
        }

        if($request->hasFile('img2_pr')) {
            $validated['img2_pr'] = $request->file('img2_pr')->store('productos', 'public');
        }

        if($request->hasFile('img3_pr')) {
            $validated['img3_pr'] = $request->file('img3_pr')->store('productos', 'public');
        }

        Producto::create($validated);
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
        $producto = Producto::find($id_producto);
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo'
        ]);

        if($request->hasFile('img1_pr')) {
            $validated['img1_pr'] = $request->file('img1_pr')->store('productos', 'public');
        }

        if($request->hasFile('img2_pr')) {
            $validated['img2_pr'] = $request->file('img2_pr')->store('productos', 'public');
        }

        if($request->hasFile('img3_pr')) {
            $validated['img3_pr'] = $request->file('img3_pr')->store('productos', 'public');
        }

        $producto->update($validated);
        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
