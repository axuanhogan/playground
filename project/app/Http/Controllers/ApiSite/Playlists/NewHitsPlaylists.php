<?php

namespace App\Http\Controllers\ApiSite\Playlists;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//My Library
use ApiLibrary;

class NewHitsPlaylists extends Controller
{
    /**
     * Request
     *
     * @var array
     */
    private $request = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
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
                $result = $this->getNewHitsPlaylists();
                break;
        }

        return $result;
    }

    /**
     * GET method
     *
     * @return json
     */
    private function getNewHitsPlaylists(): json
    {
        $query_string_parameter = $this->request->all();
        $territory = !empty($query_string_parameter['territory']) ? $query_string_parameter['territory'] : 'TW';
        $limit = !empty($query_string_parameter['limit']) ? $query_string_parameter['limit'] : 5;

        $api_library = new ApiLibrary();
        $api_library->url = 'https://test.com';
        $api_library->header = [
            'accept' => 'application/json',
        ];
        $api_library->query = [
            'territory' => $territory,
            'limit' => $limit,
        ];
        $response = $api_library->get();
        $result = $response->getBody();

        return $result;
    }
}
