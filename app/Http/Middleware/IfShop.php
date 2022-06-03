<?php

namespace App\Http\Middleware;

use Closure;

class IfShop
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
        if(!isset(auth()->user()->shop)) {
            return redirect(route('shop.create'));
        }
        return $next($request);
    }
}
