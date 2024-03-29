<form class="mt-6" action="{{ route('playlists.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mx-auto max-w-2xl space-y-4">

        <label for="file">Image</label>
        <input name="image" type="file"/>

        <div class="space-y-2">
            <x-label for="title" :value="__('Title')">Title</x-label>
            <x-input id="title" placeholder="Your playlist title" name="title" required type="text"/>
            <x-input-error :messages="$errors->get('title')"/>
        </div>

        <!-- Song Inputs Section -->
        <div id="songs-container" class="space-y-2">
            <h3 class="text-xl">Songs</h3>

            @foreach($songs as $index => $song)
                <fieldset id="song_{{$index}}_container" class="py-0.5">
                    <div class="flex gap-2">
                        <x-input id="song_{{$index}}_title" placeholder="Song Title" name="songs[{{$index}}][title]"
                                 required type="text"/>
                        <x-input id="song_{{$index}}_author" placeholder="Author" name="songs[{{$index}}][author]"
                                 required type="text"/>
                        <x-select class="max-w-[120px]" id="song_{{$index}}_genre" name="songs[{{$index}}][genre]"
                                  required>
                            @foreach ($genres as $genre)
                                <option value="{{$genre}}">{{$genre}}</option>
                            @endforeach
                        </x-select>
                        <x-button-primary type="button" class="text-white font-medium"
                                          wire:click="removeSong({{$index}})">
                            <svg width="12" height="15" viewbox="0 0 12 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.72787 12.8495C1.72787 13.267 1.89127 13.6675 2.18213 13.9628C2.47299 14.258 2.86748 14.4239 3.27882 14.4239H9.48261C9.89395 14.4239 10.2884 14.258 10.5793 13.9628C10.8702 13.6675 11.0336 13.267 11.0336 12.8495V3.4028H1.72787V12.8495ZM3.27882 4.97724H9.48261V12.8495H3.27882V4.97724ZM9.09487 1.04113L8.3194 0.253906H4.44203L3.66655 1.04113H0.952393V2.61557H11.809V1.04113H9.09487Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </x-button-primary>
                    </div>
                </fieldset>
            @endforeach
        </div>

        <!-- Button to Add New Song Input -->
        <div class="flex justify-end">
            <x-button-primary type="button" id="add-song-btn" wire:click="addSong()">
                +
            </x-button-primary>
        </div>

        <x-button-primary class="w-full">
            Create
        </x-button-primary>
    </div>
</form>
