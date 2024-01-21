<x-base-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{$playlist['name']}}</h1>
    </x-slot>

    <div>
        <div class="flex gap-6">
            <img
                class="w-64 h-auto object-cover rounded-2xl"
                width="256px"
                height="256px"
                src="{{$playlist['images'][0]['url']}}"
                alt="{{$playlist['name']}} cover"
            />

            <div>
                <h3 class="font-medium text-lg text-gray-800">
                    Owner:
                    <a href="{{$playlist['owner']['external_urls']['spotify']}}" target="_blank"
                       class="font-bold underline">
                        {{$playlist['owner']['display_name']}}
                    </a>
                </h3>

                <p class="mt-4 text-lg font-medium text-gray-600">{{$playlist['description']}}</p>
                <p class="mt-2">
                    <span class="font-medium text-gray-800">Followers:</span>
                    <strong>{{number_format($playlist['followers']['total'])}}</strong>
                </p>
            </div>
        </div>
        <p class="font-semibold text-sm text-gray-800 mt-2">{{$playlist['tracks']['total']}} tracks</p>
        @if($playlist['external_urls']['spotify'])
            @include('site.inspire.components.open-in-spotify-link', ['url' => $playlist['external_urls']['spotify']])
        @endif

        <div class="mt-6">
            <h3 class="font-medium text-4xl">Tracks</h3>

            <table class="w-full mt-4">
                <thead>
                <tr>
                    <th class="pl-4 text-left font-medium text-gray-600">#</th>
                    <th class="text-left font-medium text-gray-600">Name</th>
                    <th class="text-left font-medium text-gray-600">Album</th>
                    <th class="text-left font-medium text-gray-600">Duration</th>
                    <th class="text-center font-medium text-gray-600">Preview</th>
                </tr>
                </thead>
                <tbody>
                @foreach($playlist['tracks']['items'] as $track)
                    <tr class="border-y hover:shadow-lg transition-shadow duration-300">
                        <td class="pl-4 text-sm text-left font-medium text-gray-800 w-16">{{$loop->iteration}}</td>
                        <td class="">
                            <a class="text-left py-1 flex" href="{{$track['track']['external_urls']['spotify']}}"
                               target="_blank">
                                <img
                                    class="w-10 h-10 object-cover rounded-md inline-block mr-2"
                                    width="40px"
                                    height="40px"
                                    src="{{$track['track']['album']['images'][0]['url']}}"
                                    alt="{{$track['track']['album']['name']}} cover"
                                />
                                <div>
                                    <p class="font-bold text-gray-600">{{$track['track']['name']}}</p>
                                    <p class="font-medium text-gray-400 text-sm">
                                        @foreach($track['track']['artists'] as $artist)
                                            {{$artist['name']}}
                                            @if(!$loop->last)
                                                {{', '}}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                            </a>
                        </td>
                        <td class="text-base text-left font-medium text-gray-600">{{$track['track']['album']['name']}}</td>
                        <td class="text-sm text-center font-medium text-gray-600">
                            {{gmdate("i:s", $track['track']['duration_ms']/1000)}}
                        </td>
                        <td class="text-center">
                            @if($track['track']['preview_url'])
                                <audio controls>
                                    <source src="{{$track['track']['preview_url']}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            @else
                                <p class="text-sm text-gray-400">No preview available</p>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-base-layout>
