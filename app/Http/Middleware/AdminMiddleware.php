<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        abort(403, 'Accès interdit');

        // Vous pouvez également rediriger l'utilisateur vers une page d'erreur ou une autre action
        // return redirect()->route('error')->with('message', 'Accès interdit');

    }
}
