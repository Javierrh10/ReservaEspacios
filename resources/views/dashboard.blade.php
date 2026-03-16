<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <h2 class="font-bold text-2xl text-white tracking-tight">
            <i class="bi bi-speedometer2 me-2 text-purple-400"></i> Panel de Control
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-12 px-4">
                <span class="text-indigo-400 font-semibold text-xs uppercase tracking-widest bg-indigo-400/10 px-4 py-2 rounded-lg border border-indigo-400/20">Panel de Administración</span>
                <h3 class="text-4xl font-extrabold text-white mt-6 tracking-tight">Bienvenido, {{ Auth::user()->name }}</h3>
                <p class="text-slate-400 mt-3 text-lg max-w-2xl">Sistema de gestión de espacios y personal docente.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                
                <a href="{{ route('reservas.index') }}" class="group glass-card p-8 rounded-2xl hover:border-indigo-500/50 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-indigo-500/10 rounded-xl flex items-center justify-center mb-6">
                            <i class="bi bi-calendar-check text-2xl text-indigo-400"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Reservas</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Gestión de aulas y tramos horarios.</p>
                    </div>
                    <div class="mt-6 flex items-center text-indigo-400 font-bold text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                        Gestionar <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

                <a href="{{ route('profesores.index') }}" class="group glass-card p-8 rounded-2xl hover:border-slate-500/50 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-slate-500/10 rounded-xl flex items-center justify-center mb-6">
                            <i class="bi bi-person-badge text-2xl text-slate-400"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Profesores</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Administración de personal docente.</p>
                    </div>
                    <div class="mt-6 flex items-center text-slate-400 font-bold text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                        Ver personal <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

                <a href="{{ route('reservas.informe') }}" class="group glass-card p-8 rounded-2xl hover:border-emerald-500/50 flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-6">
                            <i class="bi bi-file-earmark-bar-graph text-2xl text-emerald-400"></i>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Informes</h4>
                        <p class="text-slate-400 text-sm leading-relaxed">Reporte de ocupación semanal.</p>
                    </div>
                    <div class="mt-6 flex items-center text-emerald-400 font-bold text-xs uppercase tracking-widest group-hover:translate-x-1 transition-transform">
                        Ver reporte <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

            </div>

            <div class="mt-12 mx-4 glass-card rounded-2xl p-6 flex items-center gap-5 border-slate-800 bg-slate-900/40">
                <div class="w-10 h-10 bg-amber-500/10 rounded-full flex items-center justify-center shrink-0">
                    <i class="bi bi-info-circle text-amber-500 text-lg"></i>
                </div>
                <div>
                    <h5 class="text-white font-bold text-lg mb-0.5">Gestión Optimizada</h5>
                    <p class="text-slate-400 text-sm">Edita y crea registros de forma ágil desde los paneles laterales.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>