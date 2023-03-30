<?php

namespace Tests\Unit\Playlists\NewHits;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use NewHitsPlaylistsTrack;

class TracklistsTest extends TestCase
{
    use RefreshDatabase;

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
        factory(NewHitsPlaylistsTrack::class, 10)->create();

        foreach ($this->language as $key => $value) {
            $this->get("$value/playlists/new-hits/show/track")
                ->assertOk()
                ->assertViewIs('Playlists.NewHits.tracklists-get')
                ->assertViewHasAll(['data', 'page_title']);
        }
    }

    public function testNewHitsPlaylistPost()
    {
        foreach ($this->language as $key => $value) {
            $this->post("$value/playlists/new-hits/show/track")
                ->assertOk()
                ->assertJsonStructure([
                    'status',
                    'message',
                ]);
        }
    }

    public function testNewHitsPlaylistPut()
    {
        foreach ($this->language as $key => $value) {
            $this->post("$value/playlists/new-hits/show/track")
                ->assertOk()
                ->assertJsonStructure([
                    'status',
                    'message',
                ]);
        }
    }

    public function testNewHitsPlaylisDelete()
    {
        foreach ($this->language as $key => $value) {
            $this->post("$value/playlists/new-hits/show/track")
                ->assertOk()
                ->assertJsonStructure([
                    'status',
                    'message',
                ]);
        }
    }
}
