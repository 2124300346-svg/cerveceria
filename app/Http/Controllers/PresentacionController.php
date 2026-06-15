<?php

namespace App\Http\Controllers;

use App\Models\Presentacion;
use Illuminate\Http\Request;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones=\DB::table('vista_presentaciones')->get();
        return view('presentaciones.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos=\DB::table('producto')->get();
        return view('presentaciones.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'id_producto' => 'required',
            'nombre_presentacion' => 'required|string|max:50',
            'cantidad_unitaria' => 'required',
            'cantidad_caja' => 'required',
            'precio_unidad' => 'required',
            'precio_caja' => 'required'
        ]);

        Presentacion::create($validated);

        return redirect()->route('presentaciones.index')->with('success', 'Presentación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Presentacion $presentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_presentacion)
    {
        $presentacion = Presentacion::findOrFail($id_presentacion);
        $productos=\DB::table('producto')->get();
        return view('presentaciones.edit', compact('presentacion', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_presentacion)
    {
        $validated = $request->validate([
            'id_producto' => 'required',
            'nombre_presentacion' => 'required|string|max:50',
            'cantidad_unitaria' => 'required',
            'cantidad_caja' => 'required',
            'precio_unidad' => 'required',
            'precio_caja' => 'required',
            'estado' => 'required'
        ]);

        $presentacion = Presentacion::find($id_presentacion);
        $presentacion->update($validated);
        return redirect()->route('presentaciones.index')->with('success', 'Presentación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Presentacion $presentacion)
    {
        $presentacion->delete();
        
        return redirect()->route('presentaciones.index')->with('success', 'Presentación eliminada exitosamente.');
    }
}