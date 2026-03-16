<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Aula;
use App\Models\Profesor;
use App\Models\FranjaHoraria;
use Carbon\Carbon;
use App\Rules\AulaDisponible;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('aula', 'profesor', 'franja')->get();
        $aulas = Aula::all();
        $profesores = Profesor::all();
        $franjas = FranjaHoraria::all();

        return view('reservas.index', compact('reservas', 'aulas', 'profesores', 'franjas'));
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
        $request->validate([
            'aula_id' => [
                'required',
                new AulaDisponible($request->aula_id, $request->fecha, $request->franja_horaria_id)
            ],
            'fecha' => 'required|date',
            'franja_horaria_id' => 'required',
            'grupo' => 'required',
            'profesor_id' => 'required|exists:profesores,id',
        ]);

        Reserva::create($request->all());
        return redirect()->route('reservas.index')->with('success', 'Reserva creada.');
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

        $request->validate([
            'aula_id' => [
                'required',
                new AulaDisponible($request->aula_id, $request->fecha, $request->franja_horaria_id, $id)
            ],
            'fecha' => 'required|date',
            'franja_horaria_id' => 'required',
            'grupo' => 'required',
        ]);

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
        $inicioSemana = Carbon::now()->startOfWeek()->toDateString();
        $finSemana = Carbon::now()->endOfWeek()->toDateString();

        $reservas = Reserva::with(['aula', 'profesor', 'franja'])
                    ->whereBetween('fecha', [$inicioSemana, $finSemana])
                    ->orderBy('fecha', 'asc')
                    ->orderBy('franja_horaria_id', 'asc')
                    ->get();

        return view('reservas.informe', [
            'reservas' => $reservas,
            'inicioSemana' => Carbon::parse($inicioSemana)->format('d/m/Y'),
            'finSemana' => Carbon::parse($finSemana)->format('d/m/Y')
        ]);
    }
}
