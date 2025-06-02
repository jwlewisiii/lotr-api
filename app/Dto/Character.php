<?php

namespace App\Dto;

class Character
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $wikiUrl,
        public ?string $race,
        public ?string $birth,
        public ?string $gender,
        public ?string $death,
        public ?string $hair,
        public ?string $height,
        public ?string $realm,
        public ?string $spouse,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['_id'] ?? '',
            name: $data['name'] ?? '',
            wikiUrl: $data['wikiUrl'] ?? null,
            race: $data['race'] ?? null,
            birth: $data['birth'] ?? null,
            gender: $data['gender'] ?? null,
            death: $data['death'] ?? null,
            hair: $data['hair'] ?? null,
            height: $data['height'] ?? null,
            realm: $data['realm'] ?? null,
            spouse: $data['spouse'] ?? null,
        );
    }
}
