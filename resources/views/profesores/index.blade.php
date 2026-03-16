<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-200 leading-tight">
                <i class="bi bi-person-badge me-2 text-blue-400"></i> Gestión de Profesores
            </h2>
            <a href="{{ route('profesores.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition duration-200 shadow-lg">
                <i class="bi bi-plus-lg me-1"></i> AÑADIR PROFESOR
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow-md flex items-center">
                    <i class="bi bi-check-circle-fill text-xl me-3"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-xl border border-gray-700">
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-700/50 text-gray-300 uppercase text-xs tracking-wider">
                                <th class="p-4 font-semibold">Nombre</th>
                                <th class="p-4 font-semibold">Departamento</th>
                                <th class="p-4 font-semibold">Email (Usuario)</th>
                                <th class="p-4 font-semibold text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($profesores as $profesor)
                            <tr class="hover:bg-gray-700/30 transition text-gray-300">
                                <td class="p-4 font-medium">{{ $profesor->nombre }}</td>
                                <td class="p-4">{{ $profesor->departamento }}</td>
                                <td class="p-4 text-blue-400 font-mono text-xs">{{ $profesor->user->email ?? 'N/A' }}</td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('profesores.edit', $profesor->id) }}" class="flex items-center gap-1 px-3 py-1 bg-blue-500/10 text-blue-400 rounded-md hover:bg-blue-500 hover:text-white transition text-xs font-bold border border-blue-500/20">
                                            <i class="bi bi-pencil"></i> Editar
                                        </a>
                                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar profesor?')">
                                            @csrf @method('DELETE')
                                            <button class="flex items-center gap-1 px-3 py-1 bg-red-500/10 text-red-400 rounded-md hover:bg-red-500 hover:text-white transition text-xs font-bold border border-red-500/20">
                                                <i class="bi bi-trash"></i> Borrar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>