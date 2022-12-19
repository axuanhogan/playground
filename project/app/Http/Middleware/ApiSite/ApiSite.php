<?php

namespace App\Http\Middleware\ApiSite;

use Closure;
use Illuminate\Http\Request;
use Response;

class ApiSite
{
    /**
     * Return API result data
     *
     * @var array
     */
    private $return_data = [
        'error_messaage' => null,
        'your_data' => []
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $access_token = $request->header('access-token');
        if (env('ACCESS_TOKEN') !== $access_token) {
            $this->return_data['error_message'] = 'verification failed (access_token error)';
            $this->return_data['your_data'] = $request;
            return Response::make(json_encode($this->return_data));
        }

        return $next($request);
    }
}
