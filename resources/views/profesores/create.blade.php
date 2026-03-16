<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex items-center text-gray-200">
            <h2 class="font-semibold text-xl leading-tight text-center w-full">
                <i class="bi bi-person-plus me-2 text-green-400"></i> Nuevo Profesor
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-2xl rounded-2xl border border-gray-700 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('profesores.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Nombre Completo</label>
                            <input type="text" name="nombre" placeholder="Nombre y apellidos" required
                                   class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-green-500 focus:border-green-500 transition shadow-sm placeholder-gray-400">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Departamento</label>
                            <select name="departamento" required class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-green-500 shadow-sm">
                                <option value="" selected disabled>Selecciona una opción</option>
                                <option value="Informática">Informática</option>
                                <option value="Comercio">Comercio</option>
                                <option value="Administración">Administración</option>
                                <option value="Fol">FOL</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Vincular con Usuario (Email)</label>
                            <select name="user_id" required class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-green-500 shadow-sm">
                                <option value="" selected disabled>Selecciona el correo del usuario</option>
                                @foreach($usuarios as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex gap-4 pt-6 border-t border-gray-700">
                            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition shadow-lg border border-green-500/50">
                                <i class="bi bi-save me-1"></i> GUARDAR PROFESOR
                            </button>
                            <a href="{{ route('profesores.index') }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-gray-300 font-bold py-3 px-4 rounded-xl text-center transition border border-gray-600">
                                CANCELAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>