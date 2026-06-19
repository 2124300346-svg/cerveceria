<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|numeric|digits:10',
            'rfc' => 'required|string|min:13|max:13|unique:cliente,rfc',
            'correo' => 'required|email|max:255|unique:cliente,correo',
            'contrasena' => 'required|string|min:8',
            'repetir_contrasena' => 'required|string|min:8|same:contrasena',
            'fecha_Nac' => 'required|date|before:18 years ago',
            'img_cliente' => 'nullable|image|max:2048',
        ]);
        $validated['img_cliente'] = 'imagenes/clientes/default.jpg';

        $cliente=Cliente::create($validated);

        if($request->hasFile('img_cliente')){
            $archivo=$request->file('img_cliente');

            $nombre='cliente_'.$cliente->id_cliente.'.'.
            $archivo->getClientOriginalExtension();

            $archivo->move(public_path('imagenes/clientes'), $nombre);

            $cliente->img_cliente='imagenes/clientes/' . $nombre;

            $cliente->save();
        }

        return redirect()->route('clientes.index')->with('success', 'cliente creado exitosamente.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_cliente)
    {
        $cliente = Cliente::find($id_cliente);
        return view('clientes.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_cliente)
    {
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:150',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|numeric|digits:10',
            'rfc' => 'required|string|min:13|max:13|unique:cliente,rfc,' . $id_cliente . ',id_cliente',
            'correo' => 'required|email|max:255|unique:cliente,correo,' . $id_cliente . ',id_cliente',
            'contrasena' => 'required|string|min:8',
            'repetir_contrasena' => 'required|string|min:8|same:contrasena',
            'fecha_Nac' => 'required|date|before:18 years ago',
            'img_cliente' => 'nullable|image|max:2048', // Validación para la imagen
        ]);

        $cliente = Cliente::find($id_cliente);

        if ($request->hasFile('img_cliente')) {

        $archivo = $request->file('img_cliente');

        $nombre = 'cliente_' . $cliente->id_cliente . '.' .
                  $archivo->getClientOriginalExtension();

        $archivo->move(public_path('imagenes/clientes'), $nombre);

        $validated['img_cliente'] = 'imagenes/clientes/' . $nombre;

    } else {

        $validated['img_cliente'] = $cliente->img_cliente;
    }

    $cliente->update($validated);

    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->estado='inactivo';
        $cliente->save();

        return redirect()
        ->route('clientes.index')
        ->with('success', 'Usuario eliminado exitosamente.');
    }
}
