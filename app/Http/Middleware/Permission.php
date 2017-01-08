<?php

namespace App\Http\Middleware;

use Closure;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission_slug)
    {
    	if(!\User::can($permission_slug))
    	{
    		return redirect('home');
    	}
        return $next($request);
    }
}
