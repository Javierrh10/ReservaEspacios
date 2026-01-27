<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de profesores</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="contenedor">
        <h1>Gestión de Profesores</h1>

        @if (session('success'))
            <div style="color: green; margin-bottom: 20px; padding: 10px; border: 1px solid green; background-color: #e6ffe6;">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('profesores.create') }}" class="boton">Añadir Profesor</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Usuario Asociado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesores as $profesor)
                    <tr>
                        <td>{{ $profesor->nombre }} {{ $profesor->apellidos }}</td>
                        <td>{{ $profesor->departamento }}</td>
                        <td>{{ $profesor->user->name }}</td>
                    </tr>
                @endforeach
        </table>
    </div>
</body>
</html>