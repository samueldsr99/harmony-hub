<x-layout title="Share your playlists">
    <section class="min-h-screen grid place-items-center w-full py-12 md:py-24 lg:py-32 xl:py-48">
        <div class="container mx-auto px-4 md:px-6">
            <div class="flex flex-col items-center space-y-4 text-center">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl/none">
                        Welcome to Harmony Hub
                    </h1>
                    <p class="mx-auto max-w-[700px] text-zinc-500 md:text-xl dark:text-zinc-400">
                        Your ultimate platform for create, share, and discover playlists.
                    </p>
                </div>
                <div class="space-x-4">
                    <a href="/signin">
                        <x-button-primary>Get Started</x-button-primary>
                    </a>
                </div>
            </div>
        </div>
    </section>

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
</x-layout>
