<x-base-layout title="{{$playlist->title}}">
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{$playlist->title}}</h1>
        <div class="mt-2 font-semibold">
            Author: <a href="{{ route('users.show', $playlist->author) }}" class="text-gray-500 underline" href="#">{{$playlist->author->name}}</a>
        </div>
    </x-slot>

    <img src="{{$playlist->getImageUrl('preview')}}" alt="{{$playlist->title}}" class="object-cover rounded-2xl border ring ring-gray-50 hover:ring-[#ff3850] transition-all duration-200" width="480" height="480">

    @auth
        <div class="flex gap-3 mt-8">
            @if(auth()->id() !== $playlist->author_id)
                <form action="{{ route('playlists.like', $playlist) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 1 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}">
                        {{$likes}} ^
                    </button>
                </form>
                <form action="{{ route('playlists.dislike', $playlist) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 2 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}">{{$dislikes}} v</button>
                </form>
            @else
                <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 1 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}" disabled>
                    {{$likes}} ^
                </button>
                <button class="inline-flex items-center justify-center px-4 py-2 rounded-2xl font-bold text-lg {{ $reaction_type_id === 1 ? 'bg-red-500 text-white ring ring-red-500' : 'bg-white text-[#ff3850]' }}" disabled>
                    {{$dislikes}} v
                </button>
            @endif
        </div>
    @endauth

    <div class="space-y-6 mt-12">
    @foreach($playlist->songs as $song)
        <div class="py-2 px-4 border-b flex justify-between">
            <div>
                <p class="font-semibold text-xl">{{$song->title}}</p>
                <a class="py-1 px-2.5 bg-amber-200 text-sm font-semibold rounded-full">{{$song->genre}}</a>
            </div>
            <div>
                <p class="text-sm text-gray-600 text-end">Artist: <span class="font-semibold">{{$song->artist}}</span></p>
                <p class="text-sm text-gray-600 text-end">{{$song->created_at}}</p>
            </div>
        </div>
    @endforeach
    </div>


    <div class="mt-12">
        @auth
            @if(auth()->user()->is_admin || auth()->id() === $playlist->author_id)
                <form action="{{ route('playlists.destroy', $playlist) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-button-error>Delete</x-button-error>
                </form>
            @endif
        @endauth
        </div>
</x-base-layout>
