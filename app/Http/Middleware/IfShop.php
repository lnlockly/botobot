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
        if(!auth()->check()) {
            return redirect(route('login'));
        }
        if ((auth()->user()->current_shop == null) && ( Route::current()->getName() != "shop.create" && Route::current()->getName() != "shop.save")) {
            return redirect(route('shop.create'));
        }
        if ((count(auth()->user()->shops) == 2) && (Route::current()->getName() == "shop.create" || Route::current()->getName() == "shop.save")) {
            return redirect(route('statistic.users'));
        }
        return $next($request);
    }
}
