<?php

namespace App\Http\Middleware;

use Closure;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class SentinelMiddleware
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
        if(Sentinel::check())
            return $next($request);
        return response()->redirectToRoute('auth')->with(['message'=>'response.unauthorized','level'=>'warning']);
    }
}
