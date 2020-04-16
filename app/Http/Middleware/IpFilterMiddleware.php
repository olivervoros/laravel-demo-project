<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IpFilterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedIps = array('123.456.789', '127.0.0.1', '::1');
        if(in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        abort(403);
    }
}
