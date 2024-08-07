<x-guest-layout>
    <x-authentication-card class="bg-white shadow-md rounded-lg p-8 mx-auto max-w-sm">
        <x-slot name="logo">
            <img src="{{ asset('image/Logo.png') }}" class="w-32 h-32 object-contain mx-auto mb-6">
        </x-slot>

        <x-validation-errors class="mb-4 text-red-500" />

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                <x-input 
                    id="email" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
            </div>

            <div class="mb-4">
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-700" />
                <x-input 
                    id="password" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password" 
                />
            </div>

            <div class="flex items-center mb-4">
                <x-checkbox 
                    id="remember_me" 
                    name="remember" 
                    class="text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                />
                <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a 
                        class="text-sm text-gray-600 hover:text-gray-900 underline" 
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button 
                    class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
