<?php

namespace App\Library;

use GuzzleHttp\Client;

/**
 * API Library
 *
 * @author Hogan
 */
class ApiLibrary
{
    /**
     * Request URL
     *
     * @var string
     */
    public $url = '';

    /**
     * Request Data
     *
     * @var array
     */
    public $header = [];

    /**
     * Request Data
     *
     * @var array
     */
    public $query = [];

    /**
     * Guzzle Client
     *
     * @var object
     */
    public $client = null;

    public function __construct()
    {
        // Guzzle Client init
        $this->client = new Client();
    }

    /**
     * GET data from API
     *
     * @return json
     */
    public function get(): json
    {
        $this->header['authorization'] = 'Bearer ' . env('ACCESS_TOKEN');

        try {
            $response = $this->client->request(
                'GET',
                $this->url,
                [
                    'connect_timeout' => 10,
                    'headers' => $this->header,
                    'query' => $this->query
                ]
            );
        } catch (\Exception $e) {
            $response = $e;
        }

        return $response;
    }

    /**
     * GET Data from local
     *
     * @return json
     */
    public function getLocal(): json
    {
        $this->header['access-token'] = env('ACCESS_TOKEN');

        try {
            $response = $this->client->request(
                'GET',
                $this->url,
                [
                    'connect_timeout' => 10,
                    'headers' => $this->header,
                    'query' => $this->query
                ]
            );
        } catch (\Exception $e) {
            $response = $e;
        }

        return $response;
    }
}
