<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchCharacterTest extends TestCase
{
    /** @test */
    public function it_returns_characters_matching_name()
    {
        $name = 'Frodo';

        $response = $this->getJson("/search/name/{$name}");

        $response->assertOk();

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'wikiUrl',
                'race',
                'birth',
                'gender',
                'death',
                'hair',
                'height',
                'realm',
                'spouse',
            ]
        ]);

        $response->assertJsonFragment([
            'name' => 'Frodo Baggins',
        ]);
    }
}
