<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Models\Menu;
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
        $menu = new Menu;
        $permission = @\Sentinel::check()->roles()->first()->permissions;
        $menuPermission = $menu->where('href','like','%'.$request->segment(3).'%')->first();
        if(in_array(@$menuPermission->id,$permission))
            return $next($request);
        abort(404);
    }
}
