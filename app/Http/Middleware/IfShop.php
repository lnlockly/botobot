<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

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
        if(!isset(auth()->user()->shop) && Route::current()->getName() != "shop.create" && Route::current()->getName() != "shop.save") {
            return redirect(route('shop.create'));
        }
        if (isset(auth()->user()->shop) && Route::current()->getName() == "shop.create" && Route::current()->getName() == "shop.save") {
            return redirect(route('statistic.users'));
        }
        return $next($request);
    }
}
