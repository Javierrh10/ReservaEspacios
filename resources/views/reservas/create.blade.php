<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Reserva</title>
    {{-- Cambiamos a la carga de Vite para que se vea bien con Breeze --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Reservar Espacio</h1>

        <form action="{{ route('reservas.store') }}" method="POST">
            @csrf 
            
            <label class="block font-medium text-gray-700">Selecciona el Aula:</label>
            <select name="aula_id" required class="w-full mt-1 mb-4 border-gray-300 rounded-md shadow-sm">
                @foreach($aulas as $aula)
                    <option value="{{ $aula->id }}">{{ $aula->nombre }} (Capacidad: {{ $aula->capacidad }})</option>
                @endforeach
            </select>

            <label class="block font-medium text-gray-700">Fecha:</label>
            <input type="date" name="fecha" required class="w-full mt-1 mb-4 border-gray-300 rounded-md shadow-sm">

            {{-- --- ESTO ES EL CALENDARIO DEL ESPACIO QUE PIDIÓ EL PROFE --- --}}
            <label class="block font-medium text-gray-700">Tramo Horario (Calendario):</label>
            <select name="franja_horaria_id" required class="w-full mt-1 mb-4 border-gray-300 rounded-md shadow-sm">
                @foreach($franjas as $franja)
                    <option value="{{ $franja->id }}">
                        {{ $franja->nombre }} ({{ \Carbon\Carbon::parse($franja->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($franja->hora_fin)->format('H:i') }})
                    </option>
                @endforeach
            </select>
            {{-- ---------------------------------------------------------- --}}

            <label class="block font-medium text-gray-700">Grupo de alumnos:</label>
            <input type="text" name="grupo" placeholder="Ej: 2º DAW" required class="w-full mt-1 mb-4 border-gray-300 rounded-md shadow-sm">

            <label class="block font-medium text-gray-700">Motivo:</label>
            <textarea name="motivo" rows="3" required class="w-full mt-1 mb-6 border-gray-300 rounded-md shadow-sm"></textarea>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                Confirmar Reserva
            </button>
        </form>
    </div>
</body>
</html>