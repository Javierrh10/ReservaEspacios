<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-gray-200">
            <h2 class="font-semibold text-xl leading-tight italic">
                <i class="bi bi-file-earmark-bar-graph me-2 text-green-400"></i> Reporte de Ocupación Semanal
            </h2>
            <span class="text-xs bg-gray-700 px-4 py-2 rounded-full border border-gray-600 font-bold tracking-wider">
                {{ $inicioSemana }} — {{ $finSemana }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-2xl">
                
                <div class="p-6 bg-gray-700/20 border-b border-gray-700">
                    <p class="text-gray-400 text-sm text-center">
                        <i class="bi bi-info-circle me-2"></i> Resumen detallado de actividades planificadas para todos los departamentos.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-gray-300 border-collapse">
                        <thead class="bg-gray-900/60 text-gray-500 text-xs uppercase font-black tracking-widest text-center">
                            <tr>
                                <th class="p-5 border-b border-gray-700">Día / Fecha</th>
                                <th class="p-5 border-b border-gray-700 text-left">Franja</th>
                                <th class="p-5 border-b border-gray-700">Espacio (Aula)</th>
                                <th class="p-5 border-b border-gray-700">Profesor</th>
                                <th class="p-5 border-b border-gray-700">Grupo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700 text-center">
                            @foreach($reservas as $reserva)
                            <tr class="hover:bg-gray-700/40 transition-colors duration-200">
                                <td class="p-5 font-mono text-sm">
                                    {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="p-5 text-left">
                                    <span class="text-green-400 font-bold">{{ $reserva->franja->nombre }}</span>
                                    <div class="text-[10px] text-gray-500 uppercase">{{ $reserva->franja->hora_inicio }} - {{ $reserva->franja->hora_fin }}</div>
                                </td>
                                <td class="p-5 italic text-gray-400">
                                    {{ $reserva->aula->nombre }}
                                </td>
                                <td class="p-5 font-semibold text-gray-200">
                                    {{ $reserva->profesor->nombre ?? 'N/A' }}
                                </td>
                                <td class="p-5">
                                    <span class="bg-gray-900 px-3 py-1.5 rounded-lg border border-gray-600 text-blue-400 font-bold text-xs">
                                        {{ $reserva->group ?? $reserva->grupo }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($reservas->isEmpty())
                    <div class="p-20 text-center text-gray-500 italic">
                        No hay registros para este periodo.
                    </div>
                @endif
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-white transition text-sm flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i> Volver al panel principal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>