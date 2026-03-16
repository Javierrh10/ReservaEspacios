<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <i class="bi bi-speedometer2"></i> {{ __('Panel de Control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Bienvenido al Sistema de Gestión</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        
                        <a href="{{ route('reservas.index') }}" class="flex flex-col items-center p-8 bg-white border-2 border-blue-100 rounded-2xl hover:border-blue-500 transition-all">
                            <i class="bi bi-calendar-event text-4xl text-blue-600 mb-3"></i>
                            <span class="font-bold text-lg">Reservas</span>
                        </a>

                        <a href="{{ route('profesores.index') }}" class="flex flex-col items-center p-8 bg-white border-2 border-green-100 rounded-2xl hover:border-green-500 transition-all">
                            <i class="bi bi-person-badge text-4xl text-green-600 mb-3"></i>
                            <span class="font-bold text-lg">Profesores</span>
                        </a>

                        <a href="{{ route('reservas.informe') }}" class="flex flex-col items-center p-8 bg-white border-2 border-purple-100 rounded-2xl hover:border-purple-500 transition-all">
                            <i class="bi bi-file-earmark-bar-graph text-4xl text-purple-600 mb-3"></i>
                            <span class="font-bold text-lg">Informes</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>