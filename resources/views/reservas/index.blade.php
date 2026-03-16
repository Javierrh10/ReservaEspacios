<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reservas</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .success { color: green; background: #e6fffa; padding: 10px; border: 1px solid green; }
        .boton-nuevo { background: #4a90e2; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>

    <h1>Gestión de Reservas de Aulas</h1>

    @if(session('success'))
        <p class="success"><strong>{{ session('success') }}</strong></p>
    @endif

    <a href="{{ route('reservas.create') }}" class="boton-nuevo">Nueva Reserva</a>

    <hr style="margin-top: 20px;">

    <table>
        <thead>
            <tr>
                <th>Aula</th>
                <th>Fecha</th>
                <th>Tramo Horario (Calendario)</th> {{-- Cambiado --}}
                <th>Grupo</th>
                <th>Motivo</th>
                <th>Profesor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->aula->nombre }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}</td>
                    
                    {{-- AQUÍ SE MUESTRA EL CALENDARIO --}}
                    <td>
                        <strong>{{ $reserva->franja->nombre }}</strong><br>
                        <small>({{ \Carbon\Carbon::parse($reserva->franja->hora_inicio)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($reserva->franja->hora_fin)->format('H:i') }})</small>
                    </td>

                    <td>{{ $reserva->grupo }}</td>
                    <td>{{ $reserva->motivo }}</td>
                    <td>{{ $reserva->profesor->nombre ?? 'Sin nombre' }}</td>
                    <td>
                        <a href="{{ route('reservas.edit', $reserva->id) }}">Editar</a>

                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>