<?php

namespace App\Http\Controllers\Playlists\NewHits;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;

// My Library
use ApiLibrary;

// Services
use Tracklists as TracklistsService;

class Tracklists extends Controller
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
        switch ($this->request->method()) {
            case 'GET':
                $result = $this->getTrackLists();
                break;
            case 'POST':
                $result = $this->postTrackLists();
                break;
            case 'PUT':
                $result = $this->putTrackLists();
                break;
            case 'DELETE':
                $result = $this->deleteTrackLists();
                break;
        }

        return $result;
    }

    /**
     * GET method
     *
     * @return view|with:array
     */
    private function getTrackLists(): ?view
    {
        $page_title = 'new_hits_playlists_track';

        $new_hits_playlists_track = $this->tracklistsService->getTrackLists();

        $data = [
            'new_hits_playlists_track' => $new_hits_playlists_track,
        ];

        return view('Playlists.NewHits.tracklists-get')->with('data', $data)
                                                        ->with('page_title', $page_title);
    }

    /**
     * POST method
     *
     * @return json
     */
    private function postTrackLists(): json
    {
        $validator = $this->tracklistsService->postValidator($this->request);
        if ($validator->fails()) {
            return Response::make(
                json_encode([
                    'status' => 001,
                    'message' => 'Data verification error'
                ])
            );
        }

        $this->tracklistsService->firstOrCreate($this->request);

        return Response::make(
            json_encode([
                'status' => 200,
                'message' => 'success'
            ])
        );
    }

    /**
     * PUT method
     *
     * @return json
     */
    private function putTrackLists(): json
    {
        $validator = $this->tracklistsService->putValidator($this->request);
        if ($validator->fails()) {
            return Response::make(
                json_encode([
                    'status' => 001,
                    'message' => 'Data verification error'
                ])
            );
        }

        if (!$repeat_validator = $this->tracklistsService->repeatValidator($this->request->input('id'))) {
            return Response::make(
                json_encode([
                    'status' => 002,
                    'message' => 'Data does not exist'
                ])
            );
        }

        $result = $this->tracklistsService->update($this->request);

        return Response::make(
            json_encode([
                'status' => 200,
                'message' => 'success',
                'data' => [
                    'annotation' =>$this->request->input('annotation')
                ]
            ])
        );
    }

    /**
     * DELETE method
     *
     * @return json
     */
    private function deleteTrackLists(): json
    {
        $validator = $this->tracklistsService->deleteValidator($this->request);
        if ($validator->fails()) {
            return Response::make(
                json_encode([
                    'status' => 001,
                    'message' => 'Data verification error'
                ])
            );
        }

        if (!$repeat_validator = $this->tracklistsService->repeatValidator($this->request->input('id'))) {
            return Response::make(
                json_encode([
                    'status' => 002,
                    'message' => 'Data does not exist'
                ])
            );
        }

        $result = $this->tracklistsService->delete($this->request);

        return Response::make(
            json_encode([
                'status' => 200,
                'message' => 'success',
            ])
        );
    }
}
