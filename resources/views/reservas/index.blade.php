<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-gray-200">
            <h2 class="font-semibold text-xl leading-tight">
                <i class="bi bi-calendar-check me-2 text-purple-400"></i> Gestión de Reservas
            </h2>
            <a href="{{ route('reservas.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-2 rounded-xl text-sm font-bold transition-all shadow-lg border border-purple-500/50">
                <i class="bi bi-calendar-plus me-1"></i> NUEVA RESERVA
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-blue-100 border-l-4 border-blue-500 text-blue-800 rounded shadow-md flex items-center max-w-7xl mx-auto">
                    <i class="bi bi-info-circle-fill text-xl me-3"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-800 shadow-2xl rounded-2xl border border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-gray-300 border-collapse">
                        <thead class="bg-gray-900/60 text-gray-500 text-xs uppercase font-black tracking-widest text-center">
                            <tr>
                                <th class="p-5 border-b border-gray-700">Fecha</th>
                                <th class="p-5 border-b border-gray-700 text-left">Tramo Horario</th>
                                <th class="p-5 border-b border-gray-700">Aula / Espacio</th>
                                <th class="p-5 border-b border-gray-700">Profesor</th>
                                <th class="p-5 border-b border-gray-700">Grupo</th>
                                <th class="p-5 border-b border-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 text-center">
                            @forelse($reservas as $reserva)
                            <tr class="hover:bg-gray-700/40 transition-colors duration-200">
                                <td class="p-5 font-mono text-sm">
                                    {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="p-5 text-left">
                                    <span class="bg-purple-500/20 text-purple-400 px-3 py-1 rounded-lg text-xs font-bold border border-purple-500/30">
                                        {{ $reserva->franja->nombre }}
                                    </span>
                                    <div class="text-[10px] text-gray-500 mt-1 ml-1 uppercase">
                                        {{ substr($reserva->franja->hora_inicio, 0, 5) }} - {{ substr($reserva->franja->hora_fin, 0, 5) }}
                                    </div>
                                </td>
                                <td class="p-5 italic text-gray-400">
                                    <i class="bi bi-door-open me-1"></i> {{ $reserva->aula->nombre }}
                                </td>
                                <td class="p-5 font-semibold text-gray-200">
                                    {{ $reserva->profesor->nombre ?? 'Sin asignar' }}
                                </td>
                                <td class="p-5">
                                    <span class="bg-gray-900 px-3 py-1.5 rounded-lg border border-gray-600 text-blue-400 font-bold text-xs">
                                        {{ $reserva->grupo }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <div class="flex justify-center gap-4">
                                        <a href="{{ route('reservas.edit', $reserva->id) }}" class="text-blue-400 hover:text-blue-200 transition-transform hover:scale-110">
                                            <i class="bi bi-pencil-square text-xl"></i>
                                        </a>
                                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-200 transition-transform hover:scale-110">
                                                <i class="bi bi-trash text-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-20 text-center text-gray-500 italic">
                                    <i class="bi bi-calendar-x text-5xl mb-4 block"></i>
                                    No hay reservas registradas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-white transition text-sm flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Volver al panel principal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>