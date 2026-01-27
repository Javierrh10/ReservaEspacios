<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\User;


class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profesores = Profesor::with('user')->get();
        return view('profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profesores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email|unique:users,email|unique:profesores,email',
            'departamento' => 'required',
        ]);

        // Crear el usuario automáticamente
        $user = User::create([
            'name' => $request->nombre . ' ' . $request->apellidos,
            'email' => $request->email,
            'password' => bcrypt('1234'), // Contraseña por defecto
        ]);

        // Crear el profesor asociado al usuario
        Profesor::create([
            'user_id' => $user->id,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'departamento' => $request->departamento,
        ]);

        return redirect()->route('profesores.index')->with('success', 'Profesor creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->delete();
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado correctamente.');
    }
}
