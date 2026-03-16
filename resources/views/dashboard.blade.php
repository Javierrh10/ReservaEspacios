<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <h2 class="font-semibold text-xl text-white leading-tight">
            <i class="bi bi-speedometer2 me-2"></i> {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-10 px-4">
                <h3 class="text-3xl font-extrabold text-white">Bienvenido, {{ Auth::user()->name }} 👋</h3>
                <p class="text-gray-300 mt-2">Sistema de Gestión de Espacios e Inventario</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4">
                
                <a href="{{ route('reservas.index') }}" class="group bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-purple-500 transition-all duration-300 shadow-2xl flex flex-col justify-between">
                    <div>
                        <div class="w-16 h-16 bg-purple-500/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="bi bi-calendar-check text-4xl text-purple-400"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-2">Reservas</h4>
                        <p class="text-gray-200 leading-relaxed">Gestiona aulas y tramos horarios ocupados.</p>
                    </div>
                    <div class="mt-6 flex items-center text-purple-400 font-semibold group-hover:translate-x-2 transition-transform">
                        Ir a gestión <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

                <a href="{{ route('profesores.index') }}" class="group bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-green-500 transition-all duration-300 shadow-2xl flex flex-col justify-between">
                    <div>
                        <div class="w-16 h-16 bg-green-500/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="bi bi-person-badge text-4xl text-green-400"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-2">Profesores</h4>
                        <p class="text-gray-200 leading-relaxed">Administra el personal docente y sus datos.</p>
                    </div>
                    <div class="mt-6 flex items-center text-green-400 font-semibold group-hover:translate-x-2 transition-transform">
                        Ver listado <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

                <a href="{{ route('reservas.informe') }}" class="group bg-gray-800 p-8 rounded-3xl border border-gray-700 hover:border-blue-500 transition-all duration-300 shadow-2xl flex flex-col justify-between">
                    <div>
                        <div class="w-16 h-16 bg-blue-500/20 rounded-2xl flex items-center justify-center mb-6">
                            <i class="bi bi-file-earmark-bar-graph text-4xl text-blue-400"></i>
                        </div>
                        <h4 class="text-2xl font-bold text-white mb-2">Informes</h4>
                        <p class="text-gray-200 leading-relaxed">Reporte de ocupación semanal completo.</p>
                    </div>
                    <div class="mt-6 flex items-center text-blue-400 font-semibold group-hover:translate-x-2 transition-transform">
                        Ver reporte <i class="bi bi-arrow-right ms-2"></i>
                    </div>
                </a>

            </div>

            <div class="mt-12 mx-4 bg-gray-800 border border-gray-700 rounded-2xl p-6 flex items-start gap-4 shadow-xl">
                <i class="bi bi-lightbulb text-blue-400 text-3xl mt-1"></i>
                <div>
                    <h5 class="text-white font-bold text-lg mb-1">Consejo de uso</h5>
                    <p class="text-gray-200 text-sm leading-relaxed">Consulta el Reporte de Ocupación Semanal para verificar la disponibilidad de las aulas antes de realizar una nueva reserva.</p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>