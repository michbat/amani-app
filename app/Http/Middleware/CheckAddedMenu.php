<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class CheckAddedMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $verify = false;

        foreach (Cart::instance('cart')->content() as $content) {
            if ($content->associatedModel == "App\Models\Menu") {
                $verify = true;
            }
        }

        if (Auth::check() && Auth::user()->firstname == "Generic") {
            return $next($request);
        }

        if (count(Cart::instance('cart')->content()) == 0 || $verify == false) {
            if ($verify == false) {
                Cart::instance('cart')->destroy();
            }
            return redirect()->route('menu');
        }
        return $next($request);
    }
}
