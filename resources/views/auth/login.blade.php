<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-white mb-2">Bienvenido</h1>
        <p class="text-slate-400">Inicia sesión para gestionar espacios</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Correo electrónico" class="text-slate-400 mb-2" />
            <input id="email" class="w-full glass-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <x-input-label for="password" value="Contraseña" class="text-slate-400" />
                @if (Route::has('password.request'))
                    <a class="text-xs text-indigo-400 hover:text-indigo-300 transition" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>
            <input id="password" class="w-full glass-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded bg-slate-950 border-slate-800 text-indigo-600 focus:ring-indigo-500" name="remember">
            <span class="ms-2 text-sm text-slate-400">Mantener sesión iniciada</span>
        </div>

        <button class="w-full btn-premium btn-purple py-3 text-lg">
            Entrar al Panel
        </button>

        @if (Route::has('register'))
            <p class="text-center text-sm text-slate-500 mt-6">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Regístrate gratis</a>
            </p>
        @endif
    </form>
</x-guest-layout>
