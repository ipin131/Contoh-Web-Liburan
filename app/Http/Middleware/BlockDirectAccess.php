<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockDirectAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika akses langsung melalui browser tanpa referer, blokir
        if (!$request->headers->has('referer')) {
            abort(403, 'Akses tidak diizinkan!');
        }

        return $next($request);
    }
}
?>