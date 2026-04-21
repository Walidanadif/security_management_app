<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Middleware AdminMiddleware
 * Vérifie que l'utilisateur est un administrateur
 * Empêche l'accès aux routes protégées aux non-administrateurs
 */
class AdminMiddleware
{
    /**
     * Intercepte la requête et vérifie le rôle de l'utilisateur
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté ET a le rôle 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            // L'utilisateur est admin, on autorise la requête
            return $next($request);
        }

        // L'utilisateur n'est pas admin, on retourne une erreur 403
        abort(403, "Accès réservé à l'administrateur");
    }
}

