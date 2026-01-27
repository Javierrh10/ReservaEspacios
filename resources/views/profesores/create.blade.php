<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Profesor</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="contenedor">
        <h1>Registrar Nuevo Profesor</h1>

        @if ($errors->any())
            <div style="color: red; margin-bottom: 20px; padding: 10px; border: 1px solid red; background-color: #ffe6e6;">
                <strong>Errores de validación:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profesores.store') }}" method="POST">
            @csrf
            
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>
            @error('nombre')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
            <br><br>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="{{ old('apellidos') }}" required>
            @error('apellidos')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
            <br><br>

            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
            <br><br>

            <label>Departamento:</label>
            <input type="text" name="departamento" value="{{ old('departamento') }}" required>
            @error('departamento')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
            <br><br>

            <button type="submit" class="boton">Guardar Profesor</button>
            <a href="{{ route('profesores.index') }}" class="boton" style="display: inline-block; text-decoration: none;">Cancelar</a>
        </form>
    </div>
</body>
</html>