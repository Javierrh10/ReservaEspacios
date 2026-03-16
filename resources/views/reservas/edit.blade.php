<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex items-center text-gray-200">
            <h2 class="font-semibold text-xl leading-tight">
                <i class="bi bi-pencil-square me-2 text-blue-400"></i> Modificar Reserva #{{ $reserva->id }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded shadow-md">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-gray-800 shadow-2xl rounded-2xl border border-gray-700 overflow-hidden">
                <div class="p-8">
                    <form action="{{ route('reservas.update', $reserva->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-calendar3 me-1"></i> Fecha de Reserva
                                </label>
                                <input type="date" name="fecha" value="{{ old('fecha', $reserva->fecha) }}" required 
                                       class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-door-open me-1"></i> Aula / Espacio
                                </label>
                                <select name="aula_id" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    @foreach($aulas as $aula)
                                        <option value="{{ $aula->id }}" {{ $reserva->aula_id == $aula->id ? 'selected' : '' }}>
                                            {{ $aula->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-clock me-1"></i> Tramo Horario
                                </label>
                                <select name="franja_horaria_id" required class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    @foreach($franjas as $franja)
                                        <option value="{{ $franja->id }}" {{ $reserva->franja_horaria_id == $franja->id ? 'selected' : '' }}>
                                            {{ $franja->nombre }} ({{ substr($franja->hora_inicio, 0, 5) }} - {{ substr($franja->hora_fin, 0, 5) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-people me-1"></i> Grupo
                                </label>
                                <input type="text" name="grupo" value="{{ old('grupo', $reserva->grupo) }}" required placeholder="Ej: 1º DAM"
                                       class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                <i class="bi bi-chat-left-text me-1"></i> Motivo de la reserva
                            </label>
                            <textarea name="motivo" rows="3" class="w-full bg-gray-900 border-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition">{{ old('motivo', $reserva->motivo) }}</textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                            <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg border border-blue-500/50 flex items-center justify-center">
                                <i class="bi bi-check2-circle me-2 text-lg"></i> ACTUALIZAR RESERVA
                            </button>
                            <a href="{{ route('reservas.index') }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-gray-300 font-bold py-3 px-6 rounded-xl text-center transition-all border border-gray-600">
                                CANCELAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-6 text-center text-gray-500 text-xs">
                <i class="bi bi-info-circle me-1"></i> Los cambios se verán reflejados inmediatamente en el informe semanal.
            </p>
        </div>
    </div>
</x-app-layout>