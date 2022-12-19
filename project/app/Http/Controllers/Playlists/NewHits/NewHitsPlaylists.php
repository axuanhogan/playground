<?php

namespace App\Http\Controllers\Playlists\NewHits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// My Library
use ApiLibrary;

// Services
use Tracklists as TracklistsService;

class NewHitsPlaylists extends Controller
{
    /**
     * Request
     *
     * @var array
     */
    private $request = null;

    /**
     * Service Tracklist
     *
     * @var object
     */
    private $tracklistsService = null;

    public function __construct(Request $request, TracklistsService $tracklistsService)
    {
        $this->request = $request;
        $this->tracklistsService = $tracklistsService;
    }

    /**
     * 入口
     *
     * @return json
     */
    public function entrance(): json
    {
        switch ($this->request->route()->parameter('show')) {
            case 'show':
                $result = $this->showNewHitsPlaylistsPage();
                break;
            default:
                $result = $this->getNewHitsPlaylistsPage();
                break;
        }

        return $result;
    }

    /**
     * Show Button Page
     *
     * @return view
     */
    private function getNewHitsPlaylistsPage(): view
    {
        $page_title = 'search_page';

        return view('Playlists.NewHits.new-hits-playlists-get')->with('page_title', $page_title);
    }

    /**
     * Show list data
     *
     * @return view|array
     */
    private function showNewHitsPlaylistsPage(): ?view
    {
        $page_title = 'new_hits_playlists';

        $api_library = new ApiLibrary();
        $api_library->url = action('ApiSite\Playlists\NewHitsPlaylists@entrance');
        $api_library->header = [
            'accept' => 'application/json',
        ];
        $api_library->query = [
            'territory' => 'TW',
        ];

        $response = $api_library->getLocal();
        $new_hits_playlists = json_decode($response->getBody(), true);

        $new_hits_playlists_track = $this->tracklistsService->getTrackLists();
        foreach ($new_hits_playlists['data'] as $data_key => $data_value) {
            $new_hits_playlists['data'][$data_key]['tracked'] = false;
            foreach ($new_hits_playlists_track as $track_key => $track_value) {
                if ($track_value->id == $data_value['id']) {
                    $new_hits_playlists['data'][$data_key]['tracked'] = true;
                }
            }
        }

        $data = [
            'new_hits_playlists' => $new_hits_playlists['data']
        ];

        return view('Playlists.NewHits.new-hits-playlists-show')->with('page_title', $page_title)
                                                                ->with('data', $data);
    }
}
