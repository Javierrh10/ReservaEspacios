<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            <i class="bi bi-pencil-square me-2 text-blue-400"></i> Editar Profesor: {{ $profesor->nombre }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-2xl rounded-2xl border border-gray-700 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('profesores.update', $profesor->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Nombre del Profesor</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $profesor->nombre) }}" 
                                   class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Departamento</label>
                            <select name="departamento" class="w-full bg-gray-900 border-gray-700 rounded-lg">
                                <option value="Informática" {{ $profesor->departamento == 'Informática' ? 'selected' : '' }}>Informática</option>
                                <option value="Comercio" {{ $profesor->departamento == 'Comercio' ? 'selected' : '' }}>Comercio</option>
                                <option value="Administración" {{ $profesor->departamento == 'Administración' ? 'selected' : '' }}>Administración</option>
                                <option value="Fol" {{ $profesor->departamento == 'Fol' ? 'selected' : '' }}>FOL</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Usuario (Email)</label>
                            <select name="user_id" class="w-full bg-gray-900 border-gray-700 rounded-lg">
                                @foreach($usuarios as $user)
                                    <option value="{{ $user->id }}" {{ $profesor->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-4 pt-4 border-t border-gray-700">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                ACTUALIZAR DATOS
                            </button>
                            <a href="{{ route('profesores.index') }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-gray-300 font-bold py-2 px-4 rounded-lg text-center transition">
                                CANCELAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>