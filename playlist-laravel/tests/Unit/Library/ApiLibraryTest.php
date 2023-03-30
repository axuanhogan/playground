<?php

namespace Tests\Unit\ApiSite;

use Tests\TestCase;
use GuzzleHttp\Client;
use Mockery;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

//My Library
use ApiLibrary;

class ApilibraryTest extends TestCase
{
    /**
     * Test ApiLibrary
     */
    public function testApilibrary()
    {
        $mock = new MockHandler([
            new Response(200, [], 'success'),
        ]);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);
        $client_request = $client->request('GET', '/');

        $mock = Mockery::mock(ApiLibrary::class);
        $this->app->instance(ApiLibrary::class, $mock);
        $mock->shouldReceive('getLocal')
                    ->once()
                    ->andReturn($client_request);
        $result = $mock->getLocal()->getStatusCode();
        
        $this->assertEquals(200, $result);
    }
}
