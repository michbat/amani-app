<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpFoundation\Response;

class CheckAddedPlat
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $verify = false;  // Variable drapeau pour vérifier la présence d'un plat dans le panier


        if(Cart::instance('cart')->count() > 0)
        {
            foreach (Cart::instance('cart')->content() as $content) {
                if ($content->associatedModel == "App\Models\Plat") {
                    $verify = true;  // Se met à true s'il y a un plat dans le panier
                    break;  // On arrête l'itération si un plat est trouvé dans le panier
                }
            }
        }


        // Si l'utilisateur est connecté et qu'il est 'Generic', il a la permission de franchir le middleware
        if (Auth::check() && Auth::user()->firstname == "Generic") {
            // Il peut ajouter les boissons sans les plats
            return $next($request);
        }

        // Si le panier est vide ou qu'il n'y trouve pas de plat
        if (count(Cart::instance('cart')->content()) == 0 || $verify == false) {
            // S'il n'y a pas de plat
            // if ($verify == false) {
            //     Cart::instance('cart')->destroy();  // On dettuit l'instance du panier
            // }
            return redirect()->route('plat');  // On redirige l'utilisateur vers la page des plats"
        }
        return $next($request);
    }
}
