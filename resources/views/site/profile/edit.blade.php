<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">Your Profile</h1>
    </x-slot>

    <form action="{{ route('profile.update') }}" method="post">
        @csrf
        @method('patch')

        <div class="mx-auto max-w-2xl space-y-4">
            <div class="space-y-2">
                <x-label for="name" :value="__('Name')">Name</x-label>
                <x-input id="name" placeholder="Your name" name="name" :value="old('name', $user->name)" required type="text" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="space-y-2">
                <x-label for="email" :value="__('Email')">Email</x-label>
                <x-input id="email" placeholder="Your email" name="email" :value="old('email', $user->email)" required type="email" />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            @if(session()->has('status') && session('status') === 'profile-updated')
                <div class="text-green-500 text-sm">Updated!</div>
            @endif

            <x-button-primary>Update</x-button-primary>
        </div>
    </form>
</x-base-layout>
