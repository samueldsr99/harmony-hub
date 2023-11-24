<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">Admin: Playlists</h1>
    </x-slot>

    <ul class="max-w-4xl mx-auto divide-y-2">
        @foreach($playlists as $playlist)
            <li class="flex justify-between items-center py-4">
                <div>
                    <p class="font-medium {{$playlist->deleted_at ? 'text-red-500' : ''}}">{{$playlist->title}}</p>
                    <span class="text-sm">{{$playlist->created_at}}</span>
                </div>
                @if(!$playlist->deleted_at)
                    <form action="{{ route('admin.playlists.delete', $playlist) }}" method="post">
                        @csrf
                        @method('patch')
                        <x-button-primary class="h-9">Delete</x-button-primary>
                    </form>
                @else
                    <form action="{{ route('admin.playlists.restore', $playlist) }}" method="post">
                        @csrf
                        @method('patch')
                        <x-button-info class="h-9">Restore</x-button-info>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>
</x-base-layout>
