<?php

namespace App\Http\Middleware;

use Closure;

class Access
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
        
        if ( auth()->check() && auth()->user()->is_admin == true )
        {
            return $next($request);
        }

        return redirect('/login');
    }
}
