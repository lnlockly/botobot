<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;

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
        if(!isset(auth()->user()->shop) && Route::current()->getName() != "shop.create") {
            return redirect(route('shop.create'));
        }
        return $next($request);
    }
}
