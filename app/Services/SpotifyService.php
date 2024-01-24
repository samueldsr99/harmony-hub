<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

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

    public function getPlaylist(string $spotify_playlist_id)
    {
        return cache()->remember(
            key: 'spotify_playlist_' . $spotify_playlist_id,
            ttl: $this->cache_ttl,
            callback: fn() => $this->fetchPlaylist($spotify_playlist_id)
        );
    }

    public function fetchPlaylist(string $spotify_playlist_id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
        ])
            ->withResponseMiddleware(
                fn($response) => $this->invalidateWhenUnauthorized($response)
            )
            ->get($this->base_url . '/playlists/' . $spotify_playlist_id);

        return $response->json();
    }

    public function getToken()
    {
        $access_token = cache('spotify_access_token');
        if ($access_token) {
            return $access_token;
        }

        $base64_credentials = base64_encode($this->client_id . ':' . $this->client_secret);

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . $base64_credentials,
        ])->asForm()->post($this->token_url, [
            'grant_type' => 'client_credentials',
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
        ]);

        $access_token = $response->json()['access_token'];

        cache(['spotify_access_token' => $access_token], $this->cache_ttl);
        return $access_token;
    }

    private function invalidateWhenUnauthorized(ResponseInterface $response): ResponseInterface
    {
        if ($response->getStatusCode() === 401) {
            cache()->forget('spotify_access_token');

            $url = $response->getHeader('Location')[0];
            return Http
                ::withHeaders(['Authorization' => 'Bearer ' . $this->getToken()])
                ->get($url)->json();
        }

        return $response;
    }

    public function getFeaturedPlaylists()
    {
        return cache()->remember(
            key: 'spotify_featured_playlists',
            ttl: $this->cache_ttl,
            callback: fn() => $this->fetchFeaturedPlaylists()
        );
    }

    private function fetchFeaturedPlaylists()
    {
        $response = Http
            ::withHeaders(['Authorization' => 'Bearer ' . $this->getToken()])
            ->withResponseMiddleware(
                fn($response) => $this->invalidateWhenUnauthorized($response)
            )
            ->get($this->base_url . '/browse/featured-playlists');

        return $response->json();
    }
}
