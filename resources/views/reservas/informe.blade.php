<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-white">
            <h2 class="font-bold text-2xl tracking-tight">
                <i class="bi bi-file-earmark-bar-graph me-2 text-emerald-400"></i> Informe Semanal
            </h2>
            <span
                class="text-[11px] bg-slate-800 px-6 py-2 rounded-lg border border-slate-700 font-bold tracking-wider uppercase text-slate-300">
                {{ $inicioSemana }} — {{ $finSemana }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="glass-card rounded-[2rem] overflow-hidden border-white/5">

                <div class="p-8 bg-white/[0.02] border-b border-white/5">
                    <p class="text-gray-400 text-sm text-center font-medium">
                        <i class="bi bi-info-circle me-3 text-blue-400"></i> Resumen detallado de actividades
                        planificadas para todos los departamentos.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <thead>
                                <tr
                                    class="bg-slate-800/50 text-slate-400 text-[11px] uppercase font-bold tracking-wider">
                                    <th class="px-8 py-5">Día / Fecha</th>
                                    <th class="px-8 py-5 text-left">Franja</th>
                                    <th class="px-8 py-5">Espacio (Aula)</th>
                                    <th class="px-8 py-5">Profesor</th>
                                    <th class="px-8 py-5">Grupo</th>
                                </tr>
                            </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($reservas as $reserva)
                                <tr class="hover:bg-white/[0.02] transition-colors">
                                    <td class="px-8 py-6 font-mono text-sm text-indigo-400">
                                        {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-8 py-6 text-left">
                                        <span
                                            class="text-emerald-400 font-semibold block mb-1 uppercase text-sm tracking-wide">{{ $reserva->franja->nombre }}</span>
                                        <div class="text-[10px] text-slate-500 font-mono">
                                            {{ $reserva->franja->hora_inicio_formateada }} -
                                            {{ $reserva->franja->hora_fin_formateada }}</div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-slate-300 flex items-center gap-2">
                                            <i class="bi bi-door-open text-slate-600"></i> {{ $reserva->aula->nombre }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="text-white font-semibold">{{ $reserva->profesor->nombre ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="px-3 py-1.5 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-bold text-[10px] tracking-wider uppercase">
                                            {{ $reserva->group ?? $reserva->grupo }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($reservas->isEmpty())
                    <div class="px-8 py-32 text-center">
                        <i class="bi bi-journal-x text-5xl text-gray-700 mb-4"></i>
                        <p class="text-gray-500 font-medium">No hay registros para este periodo.</p>
                    </div>
                @endif
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('dashboard') }}"
                    class="text-gray-500 hover:text-white transition-all text-sm flex items-center gap-2 font-medium">
                    <i class="bi bi-arrow-left"></i> Volver al panel principal
                </a>
            </div>
        </div>
    </div>
</x-app-layout>