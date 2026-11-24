<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response {
        // memeriksa apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // memriksa apakah user memiliki role
        $user = Auth::user();

        $hasRole = $user->role && in_array(
            $user->role->name,
            $roles
        );

        if (!$hasRole) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
