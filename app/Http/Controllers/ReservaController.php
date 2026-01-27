<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Aula;
use App\Models\Profesor;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = \App\Models\Reserva::with('aula', 'profesor')->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all();
        return view('reservas.create', compact('aulas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'aula_id' => 'required',
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        Reserva::create([
            'profesor_id' => 1, 
            'aula_id'     => $request->aula_id,
            'fecha'       => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin'    => $request->hora_fin,
            'grupo'       => $request->grupo,
            'motivo'      => $request->motivo,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito');
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
        $reserva = Reserva::findOrFail($id);
        $aulas = Aula::all();
        return view('reservas.edit', compact('reserva', 'aulas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $reserva = \App\Models\Reserva::findOrFail($id);

        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente');
    }
}
