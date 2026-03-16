<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white mb-2">Crear Cuenta</h1>
        <p class="text-slate-400">Únete para empezar a reservar espacios</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nombre completo" class="text-slate-400 mb-2" />
            <input id="name" class="w-full glass-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Juan Pérez" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo electrónico" class="text-slate-400 mb-2" />
            <input id="email" class="w-full glass-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="tu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Contraseña" class="text-slate-400 mb-2" />
            <input id="password" class="w-full glass-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmar contraseña" class="text-slate-400 mb-2" />
            <input id="password_confirmation" class="w-full glass-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button class="w-full btn-premium btn-purple py-3 text-lg mt-4">
            Empezar Ahora
        </button>

        <p class="text-center text-sm text-slate-500 mt-6">
            ¿Ya tienes cuenta? 
            <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Inicia sesión</a>
        </p>
    </form>
</x-guest-layout>
