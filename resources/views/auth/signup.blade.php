<x-guest-layout title="Sign Up">
    <div class="grid place-items-center min-h-screen">
        <form action="{{ route('signup') }}" method="POST">
            @csrf
            <div class="min-w-[400px] bg-white rounded-lg border bg-card text-card-foreground shadow-sm mx-auto max-w-sm">
                <div class="flex flex-col p-6 space-y-1">
                    <h3 class="tracking-tight text-2xl font-bold">Sign Up</h3>
                    <p class="text-sm text-muted-foreground">Fill in the form to create an account</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <x-label for="name" :value="__('Name')">Name</x-label>
                            <x-input id="name" placeholder="Your name" name="name" required :value="old('name')" type="name" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>
                        <div class="space-y-2">
                            <x-label for="email" :value="__('Email')">Email</x-label>
                            <x-input id="email" placeholder="m@example.com" name="email" required :value="old('email')" type="email" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                        <div class="space-y-2">
                            <x-label for="password" :value="__('Password')">Password</x-label>
                            <x-input id="password" placeholder="Your password" name="password" required :value="old('password')" type="password" />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>
                        <div class="space-y-2">
                            <x-label for="password_confirmation" :value="__('Confirm password')">Confirm password</x-label>
                            <x-input id="password_confirmation" placeholder="Confirm password" name="password_confirmation" required :value="old('password_confirmation')" type="password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" />
                        </div>
                        <x-button-primary class="w-full">
                            {{ __('Sign up') }}
                        </x-button-primary>
                    </div>
                    <div class="mt-4 text-center text-sm">
                        Already have an account?
                        <a class="underline" href="{{ route('signin') }}">
                            Sign in
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
