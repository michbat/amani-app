<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role_name): Response
    {
         // Si l'utilisateur authentifié n'a pas le nom du rôle en paramètre du middleware,il est dirigé vers sur la page 403
         // La méthode hasRole,implémentée dans la classe modèle "User", retourne une variable booléenne.
         // hasRole interroge la table "roles" pour savoir si le nom du rôle en paramètre de la fonction correspond à celui de l'utilisateur


         if (!auth()->user()->hasRole($role_name))
         {
            // L'erreur code 403 est envoyé'
            abort(403);
        }
        return $next($request);  // Le middleware a été franchi donc on peut accéder aux routes protégées par ce middleware
    }
}
