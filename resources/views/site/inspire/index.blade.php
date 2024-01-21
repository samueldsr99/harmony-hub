<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">Inspire</h1>
    </x-slot>


    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-auto">
        @foreach($playlists['items'] as $playlist)
            <div class="flex justify-start">
                <a
                    class="rounded-2xl bg-gray-800 p-4 max-w-[260px] hover:shadow-2xl transition-shadow duration-300"
                    href="{{route('inspire.show', $playlist['id'])}}"
                >
                    <img
                        class="w-full h-auto object-cover rounded-t-2xl"
                        src="{{$playlist["images"][0]["url"]}}"
                        width="64px"
                        height="64px"
                        alt="{{$playlist["name"]}} cover"
                    />
                    <div class="overflow-hidden">
                        <h3 class="text-ellipsis truncate font-bold text-base text-white mt-2">{{$playlist['name']}}</h3>
                        <p class="font-medium text-sm text-gray-300 mt-1">{{$playlist['description']}}</p>
                        <p class="font-medium text-sm text-gray-200 mt-0.5 text-end">{{$playlist['tracks']['total']}}
                            tracks</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-base-layout>
