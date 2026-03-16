<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Semanal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Informe Semanal ({{ $inicioSemana }} al {{ $finSemana }})</h1>
        
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Fecha</th>
                    <th class="p-2 border">Tramo</th>
                    <th class="p-2 border">Aula</th>
                    <th class="p-2 border">Profesor</th>
                    <th class="p-2 border">Grupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservas as $reserva)
                <tr>
                    <td class="p-2 border">{{ $reserva->fecha }}</td>
                    <td class="p-2 border">
                        {{ $reserva->franja->nombre ?? 'Sin franja' }} 
                        ({{ $reserva->franja->hora_inicio ?? '' }})
                    </td>
                    <td class="p-2 border">{{ $reserva->aula->nombre ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $reserva->profesor->nombre ?? 'N/A' }}</td>
                    <td class="p-2 border">{{ $reserva->grupo }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="mt-4">
            <a href="{{ route('dashboard') }}" class="text-blue-500 underline">Volver al Inicio</a>
        </div>
    </div>
</body>
</html>