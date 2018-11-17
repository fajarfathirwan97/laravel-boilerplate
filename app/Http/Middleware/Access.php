<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Closure;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $permissions = \Sentinel::check()->roles()->first()->permissions;
        if (in_array(\Request::route()->getName(), $permissions) || in_array("*", $permissions)) {
            return $next($request);
        }

        abort(403);
    }
}
