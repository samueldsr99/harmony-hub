<x-base-layout title="{{$playlist->title}}">
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{$playlist->title}}</h1>
        <div class="mt-2 font-semibold">
            Author: <a class="text-gray-500 underline" href="#">{{$playlist->author->name}}</a>
        </div>
    </x-slot>

    <img src="{{$playlist->getImageUrl('preview')}}" alt="{{$playlist->title}}" class="object-cover rounded-2xl border ring ring-gray-50 hover:ring-[#ff3850] transition-all duration-200" width="480" height="480">

    <div class="space-y-6 mt-12">
    @foreach($playlist->songs as $song)
        <div class="py-2 px-4 border-b flex justify-between">
            <span class="font-semibold text-xl">{{$song->title}}</span>
            <span>{{$song->artist}}</span>
        </div>
    @endforeach
    </div>


    <div class="mt-12">
        @auth
            @if(auth()->id() === $playlist->author_id)
                <form action="{{ route('playlists.destroy', $playlist) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-button-error>Delete</x-button-error>
                </form>
            @else
                <div class="flex gap-3">
                    <form action="{{ route('playlists.like', $playlist) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 1 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}">
                            +
                        </button>
                    </form>
                    <form action="{{ route('playlists.dislike', $playlist) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 2 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}">-</button>
                    </form>
                </div>

            @endif
        @endauth
        </div>
</x-base-layout>
