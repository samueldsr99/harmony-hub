<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">My playlists</h1>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($playlists as $playlist)
            <div class="px-4 py-2 rounded-2xl">
                <img src="{{$playlist->getImageUrl('preview')}}" class="object-cover rounded-2xl" alt="{{$playlist->title}}" width="128" height="128">
                <div class="flex gap-1">
                    <a class="hover:underline" href="{{ route('playlists.show', ['playlist' => $playlist]) }}">
                        <h2 class="font-bold text-2xl line-clamp-1">{{$playlist->title}}</h2>
                    </a>
                </div>
                <div class="flex items-center justify-between">
                    <span class="inline-flex items-center gap-1 text-sm text-gray-600">
                        by
                        <a class="underline">
                            <p class="font-medium">{{$playlist->author?->name ?? "Unknown author"}}</p>
                        </a>
                    </span>
                    <span class="text-sm py-0.5 px-2 rounded-full bg-red-100 text-black font-bold">{{$playlist->songs->count()}} songs</span>
                </div>
            </div>
        @endforeach
    </div>
</x-base-layout>
