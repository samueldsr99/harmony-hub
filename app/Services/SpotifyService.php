<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpotifyService
{
    private string $base_url;
    private string $token_url;
    private string $client_id;
    private string $client_secret;
    private int $cache_ttl;

    public function __construct()
    {
        $this->base_url = config('services.spotify.base_url');
        $this->token_url = config('services.spotify.token_url');
        $this->client_id = config('services.spotify.client_id');
        $this->client_secret = config('services.spotify.client_secret');
        $this->cache_ttl = config('app.env') === 'production' ? 3600 : 1;
    }

    public function getFeaturedPlaylists()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])->get($this->base_url . '/browse/featured-playlists');

        return $response->json();
    }

    public function getToken()
    {
        $base64_credentials = base64_encode($this->client_id . ':' . $this->client_secret);

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . $base64_credentials,
        ])->asForm()->post($this->token_url, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);

        return $response->json()['access_token'];
    }

    public function getPlaylist(string $spotify_playlist_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])->get($this->base_url . '/playlists/' . $spotify_playlist_id);

        return $response->json();
    }
}
