<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Reserva</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
</head>
<body>
    <div class="contenedor">
        <h1>Reservar Espacio</h1>

        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf {{-- ¡IMPORTANTE! Laravel no deja enviar formularios sin esto por seguridad --}}
            
            <label>Selecciona el Aula:</label><br>
            <select name="aula_id" required>
                @foreach($aulas as $aula)
                    <option value="{{ $aula->id }}">{{ $aula->nombre }} (Capacidad: {{ $aula->capacidad }})</option>
                @endforeach
            </select><br><br>

            <label>Fecha:</label><br>
            <input type="date" name="fecha" required><br><br>

            <label>Hora Inicio:</label><br>
            <input type="time" name="hora_inicio" required><br><br>

            <label>Hora Fin:</label><br>
            <input type="time" name="hora_fin" required><br><br>

            <label>Grupo de alumnos:</label><br>
            <input type="text" name="grupo" placeholder="Ej: 2º DAW" required><br><br>

            <label>Motivo:</label><br>
            <textarea name="motivo" rows="3" required></textarea><br><br>

            <button type="submit" class="boton">Confirmar Reserva</button>
        </form>
    </div>
</body>
</html>