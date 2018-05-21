<?php

namespace App\Http\Middleware;

use Closure;

class EnableCrossRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->server('HTTP_ORIGIN') ? $request->server('HTTP_ORIGIN') : '';
        $allow_origin = [
            'http://192.168.7.99',
            'http://192.168.7.99:8080',
            'http://192.168.7.113:8080',
            'http://192.168.7.113',
            'http://localhost:8989',
            'http://u.uootu.hd',
            'http://localhost',
            'http://localhost:8000',
            'http://120.55.68.228',
            'http://127.0.0.1:8989',
            'http://192.168.7.22:8989',
            'http://192.168.7.22',
        ];
//        if (in_array($origin, $allow_origin)) {
            $response->header('Access-Control-Allow-Origin', $origin);
            $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie,X-CSRF-TOKEN, Accept,Authorization,appid');
            $response->header('Access-Control-Expose-Headers', 'Authorization,authenticated,appid');
            $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
//        }
        return $response;
    }
}