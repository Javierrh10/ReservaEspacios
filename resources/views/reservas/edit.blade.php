<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white p-8 border border-gray-300 rounded-xl shadow-lg">
        <div class="flex items-center mb-6">
            <i class="bi bi-pencil-square text-blue-600 text-3xl mr-3"></i>
            <h1 class="text-2xl font-bold text-gray-800">Editar Reserva #{{ $reserva->id }}</h1>
        </div>

        <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- ¡Vital para que Laravel sepa que es una actualización! --}}

            <div class="mb-4">
                <label class="block font-medium text-gray-700"><i class="bi bi-door-open me-1"></i> Aula:</label>
                <select name="aula_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
                    @foreach($aulas as $aula)
                        <option value="{{ $aula->id }}" {{ $reserva->aula_id == $aula->id ? 'selected' : '' }}>
                            {{ $aula->nombre }} (Capacidad: {{ $aula->capacidad }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700"><i class="bi bi-calendar3 me-1"></i> Fecha:</label>
                <input type="date" name="fecha" value="{{ $reserva->fecha }}" required 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700"><i class="bi bi-clock me-1"></i> Tramo Horario (Calendario):</label>
                <select name="franja_horaria_id" required class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
                    @foreach($franjas as $franja)
                        <option value="{{ $franja->id }}" {{ $reserva->franja_horaria_id == $franja->id ? 'selected' : '' }}>
                            {{ $franja->nombre }} ({{ \Carbon\Carbon::parse($franja->hora_inicio)->format('H:i') }} - {{ \Carbon\Carbon::parse($franja->hora_fin)->format('H:i') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700"><i class="bi bi-people me-1"></i> Grupo de alumnos:</label>
                <input type="text" name="grupo" value="{{ $reserva->grupo }}" required 
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block font-medium text-gray-700"><i class="bi bi-chat-left-text me-1"></i> Motivo:</label>
                <textarea name="motivo" rows="3" required 
                          class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500">{{ $reserva->motivo }}</textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-2 rounded-md hover:bg-blue-700 transition shadow">
                    <i class="bi bi-check-lg mr-1"></i> Guardar Cambios
                </button>
                <a href="{{ route('reservas.index') }}" class="flex-1 bg-gray-200 text-gray-700 font-bold py-2 rounded-md hover:bg-gray-300 transition text-center shadow">
                    Cancelar
                </a>
            </div>
        </form>
    </div>

</body>
</html>