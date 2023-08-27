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
         // Si l'utilisateur n'est pas authentifié ou qu'il n'est pas admin

         if (!auth()->user() || !auth()->user()->hasRole($role_name)) {
            // L'erreur code 403 est envoyé'
            abort(403);
        }
        return $next($request);
    }
}
