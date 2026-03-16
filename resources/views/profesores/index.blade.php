<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-white" x-data="{}">
            <h2 class="font-bold text-2xl tracking-tight">
                <i class="bi bi-person-badge me-2 text-indigo-400"></i> Gestión de Profesores
            </h2>
            <button @click="$dispatch('open-modal', 'create-profesor')" class="btn-premium btn-purple">
                <i class="bi bi-plus-lg me-2"></i> AÑADIR PROFESOR
            </button>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen" x-data="{ 
        editProfesor: null,
        openEditModal(profesor) {
            this.editProfesor = profesor;
            $dispatch('open-modal', 'edit-profesor');
        }
    }" x-init="
        @if($errors->any())
            $dispatch('open-modal', 'create-profesor');
        @endif
    ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                    class="mb-6 p-4 glass-card border-blue-500/50 text-blue-400 rounded-2xl flex items-center transition-all duration-500">
                    <i class="bi bi-check-circle-fill text-xl me-3"></i>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass-card rounded-[2rem] overflow-hidden border-white/5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-800/50 text-slate-400 text-[11px] uppercase font-bold tracking-wider">
                                <th class="px-8 py-5">Nombre</th>
                                <th class="px-8 py-5">Departamento</th>
                                <th class="px-8 py-5">Email (Usuario)</th>
                                <th class="px-8 py-5 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($profesores as $profesor)
                            <tr class="hover:bg-white/[0.02] transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center text-indigo-400 font-bold border border-slate-700">
                                            {{ substr($profesor->nombre, 0, 1) }}
                                        </div>
                                        <span class="text-white font-semibold">{{ $profesor->nombre }} {{ $profesor->apellidos }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-slate-400 font-medium">
                                    {{ $profesor->departamento }}
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-indigo-400 font-mono text-xs px-2 py-1 rounded-md bg-slate-800/50">
                                        {{ $profesor->user->email ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button @click="openEditModal({{ json_encode($profesor) }})" class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-all flex items-center justify-center">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('profesores.destroy', $profesor->id) }}" method="POST" onsubmit="return confirm('¿Eliminar profesor?')">
                                            @csrf @method('DELETE')
                                            <button class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center">
                                                <i class="bi bi-trash"></i>
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

        <!-- Create Modal -->
        <x-modal name="create-profesor" :show="$errors->any()" focusable>
            <div class="p-8 bg-[#0f172a]">
                <h2 class="text-2xl font-bold text-white mb-8">Añadir Profesor</h2>
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-lg">
                        <ul class="list-disc list-inside text-sm text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('profesores.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label value="Nombre" class="text-slate-400 mb-2" />
                            <input type="text" name="nombre" required class="w-full glass-input" placeholder="Nombre">
                        </div>
                        <div>
                            <x-input-label value="Apellidos" class="text-slate-400 mb-2" />
                            <input type="text" name="apellidos" required class="w-full glass-input" placeholder="Apellidos">
                        </div>
                    </div>

                    <div>
                        <x-input-label value="Email personal" class="text-slate-400 mb-2" />
                        <input type="email" name="email" required class="w-full glass-input" placeholder="correo@ejemplo.com">
                    </div>

                    <div>
                        <x-input-label value="Departamento" class="text-slate-400 mb-2" />
                        <input type="text" name="departamento" required class="w-full glass-input" placeholder="Ej: Informática">
                    </div>

                    <div>
                        <x-input-label value="Vincular a Usuario" class="text-slate-400 mb-2" />
                        <select name="user_id" required class="w-full glass-input pr-10">
                            <option value="">Selecciona un usuario</option>
                            @foreach($usuariosDisponibles as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-4 mt-8">
                        <x-secondary-button x-on:click="$dispatch('close')" class="flex-1 py-3 justify-center">Cancelar</x-secondary-button>
                        <button type="submit" class="flex-1 btn-premium btn-purple py-3">Confirmar</button>
                    </div>
                </form>
            </div>
        </x-modal>

        <!-- Edit Modal -->
        <x-modal name="edit-profesor" focusable>
            <template x-if="editProfesor">
                <div class="p-8 bg-[#0f172a]">
                    <h2 class="text-2xl font-bold text-white mb-8">Editar Profesor</h2>
                    <form :action="'{{ url('profesores') }}/' + editProfesor.id" method="POST" class="space-y-6">
                        @csrf @method('PATCH')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label value="Nombre" class="text-slate-400 mb-2" />
                                <input type="text" name="nombre" x-model="editProfesor.nombre" required class="w-full glass-input">
                            </div>
                            <div>
                                <x-input-label value="Apellidos" class="text-slate-400 mb-2" />
                                <input type="text" name="apellidos" x-model="editProfesor.apellidos" required class="w-full glass-input">
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Email personal" class="text-slate-400 mb-2" />
                            <input type="email" name="email" x-model="editProfesor.email" required class="w-full glass-input">
                        </div>

                        <div>
                            <x-input-label value="Departamento" class="text-slate-400 mb-2" />
                            <input type="text" name="departamento" x-model="editProfesor.departamento" required class="w-full glass-input">
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