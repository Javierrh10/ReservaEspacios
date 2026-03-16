<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::with('user')->get();
        return view('profesores.index', compact('profesores'));
    }

    public function create()
    {
        $usuarios = User::all(); // Para vincular el profesor a un usuario
        return view('profesores.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especialidad' => 'required|string',
            'user_id' => 'required|exists:users,id|unique:profesores,user_id',
        ]);

        Profesor::create($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor creado correctamente');
    }

    public function edit($id)
    {
        $profesor = Profesor::findOrFail($id);
        $usuarios = User::all();
        return view('profesores.edit', compact('profesor', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $profesor = Profesor::findOrFail($id);
        $profesor->update($request->all());

        return redirect()->route('profesores.index')->with('success', 'Profesor actualizado');
    }

    public function destroy($id)
    {
        Profesor::destroy($id);
        return redirect()->route('profesores.index')->with('success', 'Profesor eliminado');
    }
}