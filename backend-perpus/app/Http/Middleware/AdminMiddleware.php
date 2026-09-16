<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 1. Import Facade Auth

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 2. Gunakan Auth::check() dan Auth::user()
        if (! Auth::check() || strtolower(Auth::user()->role) !== 'admin') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Akses ditolak. Hanya admin.'], 403);
            }

            abort(403, 'AKSES DITOLAK!');
        }

        return $next($request);
    }
}