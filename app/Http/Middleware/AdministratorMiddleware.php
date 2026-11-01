<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdministratorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() ||
            $request->user()->role !== 'administrator') {
            abort(403, 'Hanya Administrator yang dapat mengelola konten website.');
        }

        return $next($request);
    }
}