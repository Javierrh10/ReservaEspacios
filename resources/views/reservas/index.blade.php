<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-white" x-data="{}">
            <h2 class="font-bold text-2xl tracking-tight">
                <i class="bi bi-calendar-check me-2 text-indigo-400"></i> Gestión de Reservas
            </h2>
            <button @click="$dispatch('open-modal', 'create-reserva')" class="btn-premium btn-purple">
                <i class="bi bi-plus-lg me-2"></i> NUEVA RESERVA
            </button>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen" x-data="{ 
        editReserva: null,
        openEditModal(reserva) {
            this.editReserva = reserva;
            $dispatch('open-modal', 'edit-reserva');
        }
    }" x-init="
        @if($errors->any())
            $dispatch('open-modal', 'create-reserva');
        @endif
    ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                    class="mb-6 p-4 glass-card border-green-500/50 text-green-400 rounded-2xl flex items-center transition-all duration-500">
                    <i class="bi bi-check-circle-fill text-xl me-3"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass-card rounded-[2rem] overflow-hidden border-white/5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/50 text-slate-400 text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-8 py-5">Fecha</th>
                                <th class="px-8 py-5 text-left">Tramo Horario</th>
                                <th class="px-8 py-5">Aula / Espacio</th>
                                <th class="px-8 py-5">Profesor</th>
                                <th class="px-8 py-5">Grupo</th>
                                <th class="px-8 py-5 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($reservas as $reserva)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-8 py-6 font-mono text-sm text-indigo-400">
                                    {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span class="text-white font-semibold">{{ $reserva->franja->nombre }}</span>
                                        <span class="text-[10px] text-slate-500 uppercase mt-1 tracking-wider">
                                            {{ $reserva->franja->hora_inicio_formateada }} — {{ $reserva->franja->hora_fin_formateada }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="flex items-center gap-2 text-slate-300">
                                        <i class="bi bi-door-open text-indigo-400/50"></i> {{ $reserva->aula->nombre }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3 text-white font-medium">
                                        <div class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-[10px] font-bold border border-slate-700">
                                            {{ substr($reserva->profesor->nombre ?? 'S', 0, 1) }}
                                        </div>
                                        {{ $reserva->profesor->nombre ?? 'Sin asignar' }}
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-[10px] font-bold tracking-wider uppercase">
                                        {{ $reserva->grupo }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="openEditModal({{ json_encode($reserva) }})" class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta reserva?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-8 py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="bi bi-calendar-x text-6xl text-gray-700 mb-4"></i>
                                        <p class="text-gray-500 font-medium">No hay reservas registradas hoy.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-white transition-all text-sm flex items-center gap-2 font-medium">
                    <i class="bi bi-arrow-left"></i> Volver al panel principal
                </a>
            </div>
        </div>

        <!-- Create Modal -->
        <x-modal name="create-reserva" :show="$errors->any()" focusable>
            <div class="p-8 bg-[#0f172a]">
                <h2 class="text-2xl font-bold text-white mb-8">Nueva Reserva</h2>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-lg">
                        <ul class="list-disc list-inside text-sm text-red-400">
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
                            <x-input-label value="Fecha" class="text-gray-400 mb-2" />
                            <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required class="w-full glass-input">
                        </div>
                        <div>
                            <x-input-label value="Aula / Espacio" class="text-gray-400 mb-2" />
                            <select name="aula_id" required class="w-full glass-input pr-10">
                                <option value="">Selecciona aula</option>
                                @foreach($aulas as $aula)
                                    <option value="{{ $aula->id }}" {{ old('aula_id') == $aula->id ? 'selected' : '' }}>{{ $aula->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label value="Tramo Horario" class="text-gray-400 mb-2" />
                            <select name="franja_horaria_id" required class="w-full glass-input pr-10">
                                <option value="">Selecciona tramo</option>
                                @foreach($franjas as $f)
                                    <option value="{{ $f->id }}" {{ old('franja_horaria_id') == $f->id ? 'selected' : '' }}>{{ $f->nombre }} ({{ $f->hora_inicio_formateada }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label value="Grupo" class="text-gray-400 mb-2" />
                            <input type="text" name="grupo" value="{{ old('grupo') }}" placeholder="Ej: 1º DAW" required class="w-full glass-input">
                        </div>
                    </div>
                    <div>
                        <x-input-label value="Profesor Responsable" class="text-gray-400 mb-2" />
                        <select name="profesor_id" required class="w-full glass-input pr-10">
                            <option value="">Selecciona profesor</option>
                            @foreach($profesores as $p)
                                <option value="{{ $p->id }}" {{ old('profesor_id') == $p->id ? 'selected' : '' }}>{{ $p->nombre }} {{ $p->apellidos }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <x-secondary-button x-on:click="$dispatch('close')" class="flex-1 py-3 justify-center">Cancelar</x-secondary-button>
                        <button type="submit" class="flex-1 btn-premium btn-purple py-3">Confirmar Reserva</button>
                    </div>
                </form>
            </div>
        </x-modal>

        <!-- Edit Modal -->
        <x-modal name="edit-reserva" focusable>
            <template x-if="editReserva">
                <div class="p-8 bg-[#0f172a]">
                    <h2 class="text-2xl font-bold text-white mb-2">Editar Reserva</h2>
                    <p class="text-gray-400 text-sm mb-8">Modifica los detalles de la reserva seleccionada.</p>
                    
                    <form :action="'{{ url('reservas') }}/' + editReserva.id" method="POST" class="space-y-6">
                        @csrf @method('PATCH')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label value="Fecha" class="text-gray-400 mb-2" />
                                <input type="date" name="fecha" x-model="editReserva.fecha" required class="w-full glass-input">
                            </div>
                            <div>
                                <x-input-label value="Aula / Espacio" class="text-gray-400 mb-2" />
                                <select name="aula_id" x-model="editReserva.aula_id" required class="w-full glass-input pr-10">
                                    @foreach($aulas as $aula)
                                        <option value="{{ $aula->id }}">{{ $aula->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label value="Tramo Horario" class="text-gray-400 mb-2" />
                                <select name="franja_horaria_id" x-model="editReserva.franja_horaria_id" required class="w-full glass-input pr-10">
                                    @foreach($franjas as $f)
                                        <option value="{{ $f->id }}">{{ $f->nombre }} ({{ $f->hora_inicio_formateada }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label value="Grupo" class="text-gray-400 mb-2" />
                                <input type="text" name="grupo" x-model="editReserva.grupo" required class="w-full glass-input">
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Profesor Responsable" class="text-gray-400 mb-2" />
                            <select name="profesor_id" x-model="editReserva.profesor_id" required class="w-full glass-input pr-10">
                                @foreach($profesores as $p)
                                    <option value="{{ $p->id }}">{{ $p->nombre }} {{ $p->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex gap-4 mt-8">
                            <x-secondary-button x-on:click="$dispatch('close')" class="flex-1 py-3 justify-center">Cancelar</x-secondary-button>
                            <button type="submit" class="flex-1 btn-premium btn-purple py-3">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </template>
        </x-modal>
    </div>
</x-app-layout>