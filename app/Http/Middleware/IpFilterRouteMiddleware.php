<?php

namespace App\Http\Middleware;

use Closure;

class IpFilterRouteMiddleware
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
        $allowedIps = array('123.456.789');
        if(in_array($request->ip(), $allowedIps)) {
            return $next($request);
        }

        abort(403);
    }
}
