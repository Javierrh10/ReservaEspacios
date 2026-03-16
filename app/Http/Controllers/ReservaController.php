<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Aula;
use App\Models\Profesor;
use App\Models\FranjaHoraria;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('aula', 'profesor', 'franja')->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all();
        $profesores = Profesor::all();
        $franjas = FranjaHoraria::all();

        return view('reservas.create', compact('aulas', 'profesores', 'franjas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validamos los datos
        $request->validate([
            'aula_id' => 'required|exists:aulas,id',
            'fecha' => 'required|date',
            'franja_horaria_id' => 'required|exists:franja_horarias,id',
            'grupo' => 'required|string',
        ]);

        // 2. BUSCAMOS AL PROFESOR (Esto es clave)
        // Buscamos en la tabla profesores el  que tenga el user_id del que está logueado
        $profesor = \App\Models\Profesor::where('user_id', auth()->id())->first();

        // Si no lo encuentra (por ejemplo, si el admin no es "profesor"), 
        // usamos el ID 1 para que no falle la foreign key mientras pruebas.
        $profesorId = $profesor ? $profesor->id : 1;

        // 3. CREAMOS LA RESERVA
        Reserva::create([
            'profesor_id'       => $profesorId,
            'aula_id'           => $request->aula_id,
            'fecha'             => $request->fecha,
            'franja_horaria_id' => $request->franja_horaria_id,
            'grupo'             => $request->grupo,
            'motivo'            => $request->motivo,
        ]);

        return redirect()->route('reservas.index')->with('success', '¡Reserva guardada!');
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
        $franjas = FranjaHoraria::all();


        return view('reservas.edit', compact('reserva', 'aulas', 'franjas'));
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
        $reserva = Reserva::findOrFail($id);

        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente');
    }
   public function informe()
    {
        // Usamos fechas simples de PHP para evitar errores de librerías
        $inicioSemana = date('Y-m-d', strtotime('monday this week'));
        $finSemana = date('Y-m-d', strtotime('sunday this week'));

        $reservas = Reserva::with(['aula', 'profesor', 'franja'])
                    ->whereBetween('fecha', [$inicioSemana, $finSemana])
                    ->orderBy('fecha', 'asc')
                    ->get();

        // Importante: No uses Carbon aquí para las variables de la vista, manda strings simples
        return view('reservas.informe', [
            'reservas' => $reservas,
            'inicioSemana' => $inicioSemana,
            'finSemana' => $finSemana
        ]);
    }
}
