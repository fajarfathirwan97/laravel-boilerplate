<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RedirectIfAuthenticated
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
        $check = Sentinel::check();
        if($check)
            return response()->redirectToRoute('admin.dashboard');
        
        return $next($request);
    }
}
