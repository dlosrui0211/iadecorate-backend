<x-layouts::auth>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('IA DECORATE')"/>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-6">
            @csrf

            <!-- Email -->
            <flux:input
                name="email"
                :label="__('Email')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="tu@email.com"
            />

            <!-- Password -->
            <div class="relative">
                <flux:input
                    name="password"
                    :label="__('Contraseña')"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    viewable
                />

            </div>

            <div class="flex items-center justify-end">
                <flux:button variant="primary" type="submit" class="w-full text-black cursor-pointer" data-test="login-button" style="background-color: #FFFFFF">
                    {{ __('Log in') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('password.request') && Route::has('register'))
        <div class="space-x-1 text-sm text-center rtl:space-x-reverse text-zinc-600 dark:text-zinc-400">
            <flux:link :href="route('password.request')" wire:navigate> {{ __('¿Olvidaste tu contraseña?') }}</flux:link>
            <flux:link :href="route('register')" wire:navigate>{{ __('Regístrate aquí') }}</flux:link>

        </div>
        @endif
    </div>
</x-layouts::auth>
