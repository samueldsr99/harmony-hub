<x-guest-layout title="Sign In">
    <x-auth-session-status class="" :status="session('status')"/>
    <div class="grid place-items-center min-h-screen">
        <form action="{{ route('signin') }}" method="POST">
            @csrf
            <div class="min-w-[400px] bg-white rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-sm">
                <div class="flex flex-col p-6 space-y-1">
                    <h3 class="tracking-tight text-2xl font-bold">{{ __('Sign in') }}</h3>
                    <p class="text-sm text-muted-foreground">Enter your email and password to sign in to your account</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <x-label for="email" :value="__('Email')">Email</x-label>
                            <x-input id="email" placeholder="m@example.com" name="email" required :value="old('email')" type="email" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="space-y-2">
                            <x-label for="password" :value="__('Email')">Email</x-label>
                            <x-input id="password" placeholder="Your password" name="password" required :value="old('password')" type="password" />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>
                        <div class="space-y-2">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <x-button-primary class="w-full">
                            {{ __('Sign in') }}
                        </x-button-primary>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Don't have an account?
                        <a class="underline" href="{{ route('signup') }}">
                            {{ __('Sign up') }}
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
