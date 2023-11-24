<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">Users</h1>
    </x-slot>

    <ul class="space-y-6 max-w-lg px-8">
        @foreach($users as $user)
            <li class="flex items-center justify-between">
                <div class="">
                    <a href="{{ route('users.show', $user) }}" class="text-xl font-medium underline">{{$user->name}}</a>
                    <p class="text-gray-500 text-sm">Joined on: <strong class="">{{$user->created_at}}</strong></p>
                </div>
                <span class="bg-red-300 font-bold px-2 py-1.5 rounded-full text-xs">Playlists: {{$user->playlists_count}}</span>
            </li>
        @endforeach
    </ul>
</x-base-layout>
