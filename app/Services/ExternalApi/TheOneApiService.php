<?php

namespace App\Services\ExternalApi;

use App\Dto\Character;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class TheOneApiService
{
    protected TheOneApiClient $client;

    public function __construct(TheOneApiClient $client)
    {
        $this->client = $client;
    }

    public function getCharactersByName(string $name, int $limit = 100): Collection
    {
       try {
           $response = $this->client->get('character', ['name' => "/" . $name . "/i", 'limit' => $limit]);
           return collect($response['docs'] ?? [])->map(fn($char) => Character::fromArray($char));
       } catch (\Exception $e) {
           Log::error(__CLASS__.'::'.__FUNCTION__.': '.$e->getMessage());
           return new Collection([]);
       }
    }
}
