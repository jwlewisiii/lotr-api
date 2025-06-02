<?php

namespace App\Services\ExternalApi;

use Illuminate\Support\Facades\Http;

class TheOneApiClient
{
    protected string $baseUrl = 'https://the-one-api.dev/v2';

    public function get(string $endpoint, array $params = [])
    {
        return Http::withToken($this->getToken())
            ->get("{$this->baseUrl}/{$endpoint}", $params)
            ->throw()
            ->json();
    }

    protected function getToken(): string
    {
        return config('services.the_one_api.token');
    }
}
