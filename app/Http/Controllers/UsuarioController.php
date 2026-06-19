<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'puesto' => 'required|string|in:usuario,distribuidor,administrador',
            'nombre_usuario' => 'required|string|max:150',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|numeric|digits:10',
            'rfc' => 'required|string|min:13|max:13|unique:usuario,rfc',
            'correo' => 'required|email|max:255|unique:usuario,correo',
            'num_ss' => 'nullable|numeric|digits:11|unique:usuario,num_ss',
            'contrasena' => 'required|string|min:8',
            'repetir_contrasena' => 'required|string|min:8|same:contrasena',
            'fecha_Nac' => 'required|date|before:18 years ago',
            'img1_usu' => 'nullable|image|max:2048', 
        ]);

        $validated['img1_usu'] = 'imagenes/usuarios/default.jpg';

        $usuario=Usuario::create($validated);

        if($request->hasFile('img1_usu')){
            $archivo=$request->file('img1_usu');

            $nombre='usuario_'.$usuario->id_usuario.'.'.
            $archivo->getClientOriginalExtension();

            $archivo->move(public_path('imagenes/usuarios'), $nombre);

            $usuario->img1_usu='imagenes/usuarios/' . $nombre;

            $usuario->save();
        }

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_usuario)
    {
        $usuario = Usuario::find($id_usuario);
        return view('usuarios.edit', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_usuario)
{
    $usuario = Usuario::findOrFail($id_usuario);

    $validated = $request->validate([
        'puesto' => 'required|string|in:usuario,distribuidor,administrador',
        'nombre_usuario' => 'required|string|max:150',
        'direccion' => 'required|string|max:100',
        'telefono' => 'required|numeric|digits:10',
        'rfc' => 'nullable|string|min:13|max:13|unique:usuario,rfc,' . $usuario->id_usuario . ',id_usuario',
        'correo' => 'nullable|email|max:255|unique:usuario,correo,' . $usuario->id_usuario . ',id_usuario',
        'num_ss' => 'nullable|numeric|digits:11|unique:usuario,num_ss,' . $usuario->id_usuario . ',id_usuario',
        'contrasena' => 'nullable|string|min:8',
        'repetir_contrasena' => 'nullable|string|min:8|same:contrasena',
        'fecha_Nac' => 'required|date|before:18 years ago',
        'img1_usu' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('img1_usu')) {

        $archivo = $request->file('img1_usu');

        $nombre = 'usuario_' . $usuario->id_usuario . '.' .
                  $archivo->getClientOriginalExtension();

        $archivo->move(public_path('imagenes/usuarios'), $nombre);

        $validated['img1_usu'] = 'imagenes/usuarios/' . $nombre;

    } else {

        $validated['img1_usu'] = $usuario->img1_usu;
    }

    $usuario->update($validated);

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->estado='inactivo';
        $usuario->save();

        return redirect()
        ->route('usuarios.index')
        ->with('success', 'Usuario eliminado exitosamente.');
    }
}
