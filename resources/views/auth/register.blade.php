<x-guest-layout>
    <x-authentication-card class="bg-white shadow-lg rounded-lg p-10 mx-auto max-w-md">
        <x-slot name="logo">
            <img src="{{ asset('image/Logo.png') }}" class="w-24 h-24 mx-auto mb-6 object-contain">
        </x-slot>

        <x-validation-errors class="mb-4 text-red-500" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-6">
                <x-label for="name" value="{{ __('Name') }}" class="text-gray-700 font-medium" />
                <x-input 
                    id="name" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-200 focus:ring-opacity-50"
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
            </div>

            <div class="mb-6">
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-medium" />
                <x-input 
                    id="email" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-200 focus:ring-opacity-50"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autocomplete="username" 
                />
            </div>

            <div class="mb-6">
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-medium" />
                <x-input 
                    id="password" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="new-password" 
                />
            </div>

            <div class="mb-6">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-gray-700 font-medium" />
                <x-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-200 focus:ring-opacity-50"
                    type="password" 
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" 
                />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-6 flex items-center">
                    <x-checkbox 
                        name="terms" 
                        id="terms" 
                        required 
                        class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                    />
                    <label for="terms" class="ml-3 text-sm text-gray-600">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-indigo-600 hover:text-indigo-800">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-indigo-600 hover:text-indigo-800">'.__('Privacy Policy').'</a>',
                        ]) !!}
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-6">
                <a 
                    class="text-sm text-gray-600 hover:text-gray-900 underline focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                    href="{{ route('login') }}"
                >
                    {{ __('Already registered?') }}
                </a>

                <x-button 
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                >
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
