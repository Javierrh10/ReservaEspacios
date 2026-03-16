<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex items-center text-gray-200">
            <h2 class="font-semibold text-xl leading-tight text-center w-full">
                <i class="bi bi-calendar-plus me-2 text-purple-400"></i> Nueva Reserva de Espacio
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-2xl rounded-2xl border border-gray-700 overflow-hidden">
                <div class="p-8">

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded shadow-md">
                            <div class="flex items-center mb-2">
                                <i class="bi bi-exclamation-triangle-fill text-xl me-2 text-red-600"></i>
                                <span class="font-bold">No se puede realizar la reserva:</span>
                            </div>
                            <ul class="list-disc list-inside text-sm font-medium">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reservas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-calendar-event me-1"></i> Fecha
                                </label>
                                <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required 
                                       class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition shadow-sm">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-door-open me-1"></i> Aula / Espacio
                                </label>
                                <select name="aula_id" required class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-purple-500 shadow-sm">
                                    <option value="" disabled selected>Selecciona aula</option>
                                    @foreach($aulas as $aula)
                                        <option value="{{ $aula->id }}" {{ old('aula_id') == $aula->id ? 'selected' : '' }}>
                                            {{ $aula->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-clock me-1"></i> Tramo Horario
                                </label>
                                <select name="franja_horaria_id" required class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-purple-500 shadow-sm">
                                    <option value="" disabled selected>Selecciona hora</option>
                                    @foreach($franjas as $franja)
                                        <option value="{{ $franja->id }}" {{ old('franja_horaria_id') == $franja->id ? 'selected' : '' }}>
                                            {{ $franja->nombre }} ({{ $franja->hora_inicio_formateada }} - {{ $franja->hora_fin_formateada }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">
                                    <i class="bi bi-people me-1"></i> Grupo de alumnos
                                </label>
                                <input type="text" name="grupo" value="{{ old('grupo') }}" placeholder="Ej: 1º DAW / 2º ASIR" required 
                                       class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-purple-500 focus:border-purple-500 transition shadow-sm placeholder-gray-400">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">
                                <i class="bi bi-person-badge me-1"></i> Profesor Responsable
                            </label>
                            <select name="profesor_id" required class="w-full bg-white border-gray-300 text-gray-900 rounded-lg focus:ring-purple-500 shadow-sm">
                                <option value="" disabled selected>Selecciona quién realiza la reserva</option>
                                @foreach($profesores as $p)
                                    <option value="{{ $p->id }}" {{ old('profesor_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-700">
                            <button type="submit" class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg border border-purple-500/50 flex items-center justify-center">
                                <i class="bi bi-calendar-check me-2"></i> CONFIRMAR RESERVA
                            </button>
                            <a href="{{ route('reservas.index') }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-gray-300 font-bold py-3 rounded-xl text-center transition border border-gray-600">
                                CANCELAR
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>