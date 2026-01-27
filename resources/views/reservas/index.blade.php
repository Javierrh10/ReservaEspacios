<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Reservas</title>
</head>
<body>

    <h1>Gestión de Reservas de Aulas</h1>

    @if(session('success'))
        <p><strong>{{ session('success') }}</strong></p>
    @endif

    <a href="{{ route('reservas.create') }}">Nueva Reserva</a>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Aula</th>
                <th>Fecha</th>
                <th>Inicio</th>
                <th>Fin</th>
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
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora_inicio }}</td>
                    <td>{{ $reserva->hora_fin }}</td>
                    <td>{{ $reserva->grupo }}</td>
                    <td>{{ $reserva->motivo }}</td>
                    <td>{{ $reserva->profesor->nombre }}</td>
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