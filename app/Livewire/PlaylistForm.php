<?php

namespace App\Livewire;

use Livewire\Component;

class PlaylistForm extends Component
{
    public string $title;
    public $image;
    public $songs = [
        [
            'title' => '',
            'artist' => '',
            'genres' => '',
        ],
    ];
    private int $songsLimit = 10;

    public function render()
    {
        return view('livewire.playlist-form', [
            'genres' => config('genres.genres'),
        ]);
    }

    public function addSong(): void
    {
        if (count($this->songs) >= $this->songsLimit) {
            return;
        }
        $this->songs[] = [
            'title' => '',
            'artist' => '',
            'genres' => '',
        ];
    }

    public function removeSong(int $index)
    {
        unset($this->songs[$index]);
        $this->songs = array_values($this->songs);
    }
}
