<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Profesores</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        .btn { padding: 5px 10px; text-decoration: none; background: #eee; color: black; border-radius: 3px; }
    </style>
</head>
<body>
    <h1>Gestión de Profesores</h1>
    <a href="{{ route('profesores.create') }}" class="btn" style="background: #4CAF50; color: white;">Añadir Profesor</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Email (Usuario)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($profesores as $profesor)
            <tr>
                <td>{{ $profesor->nombre }}</td>
                <td>{{ $profesor->departamento }}</td>
                <td>{{ $profesor->user->email ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('profesores.edit', $profesor->id) }}" class="btn">Editar</a>
                    <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn" style="background: #f44336; color: white;">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>