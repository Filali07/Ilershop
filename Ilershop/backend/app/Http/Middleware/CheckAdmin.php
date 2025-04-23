// backend/app/Http/Middleware/CheckAdmin.php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }
        return response()->json(['message' => 'Acceso denegado. Se requiere rol de administrador.'], 403);
    }
}