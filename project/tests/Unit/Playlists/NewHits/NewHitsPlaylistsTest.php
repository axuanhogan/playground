<?php

namespace Tests\Unit\Playlists\NewHits;

use Tests\TestCase;

class NewHitsPlaylistsTest extends TestCase
{
    /**
     * All language
     *
     * @var array
     */
    private $language = [
        'tw',
        'en',
    ];

    public function testNewHitsPlaylistGet()
    {
        foreach ($this->language as $key => $value) {
            $this->get("$value/playlists/new-hits/new-hits-playlists")
                ->assertOk()
                ->assertViewIs('Playlists.NewHits.new-hits-playlists-get');
        }
    }
}
