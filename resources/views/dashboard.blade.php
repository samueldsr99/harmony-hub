<x-base-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome, {{ Auth::user()->name }} 👋!
                </div>
            </div>
        </div>
    </div>

    <div class="px-12 py-20">
        <h2 class="text-4xl text-center font-bold">Trending Playlists</h2>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($trending_playlists as $playlist)
                <div class="bg-white px-4 py-2 rounded-2xl border">
                    <a href="{{ route('playlists.show', ['playlist' => $playlist]) }}">
                        <h2 class="font-bold text-2xl line-clamp-1">{{$playlist->title}}</h2>
                        <p class="text-sm text-gray-600">{{$playlist->author?->name ?? "Unknown author"}}</p>
                        <ul class="mt-4 space-y-1 h-40 overflow-hidden relative">
                            @foreach($playlist->songs as $song)
                                <li class="text-sm">
                                    <p class="font-bold">{{$song->title}}</p>
                                    (<span class="font-semibold text-gray-400">{{$song->artist}}</span>)
                                </li>
                            @endforeach
                            <div class="absolute h-20 inset-x-0 bottom-0 bg-gradient-to-b from-transparent to-white"></div>
                        </ul>
                    </a>
                    <div class="flex justify-end">
                        <span class="text-red-500 font-semibold text-sm">Likes: {{$playlist->reaction_count}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-base-layout>
