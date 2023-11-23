<x-base-layout title="{{$playlist->title}}">
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{$playlist->title}}</h1>
        <div class="mt-2 font-semibold">
            Author: <a class="text-gray-500 underline" href="#">{{$playlist->author->name}}</a>
        </div>
    </x-slot>

    <div class="space-y-6 mt-12">
    @foreach($playlist->songs as $song)
        <div class="py-2 px-4 border-b flex justify-between">
            <span class="font-semibold text-xl">{{$song->title}}</span>
            <span>{{$song->artist}}</span>
        </div>
    @endforeach
    </div>
</x-base-layout>
