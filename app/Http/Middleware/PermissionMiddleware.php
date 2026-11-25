<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\RoleMenu;
use App\Models\Menu;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string $menuSlug,
        string $ability = 'can_view'
    ): Response {

        // Memastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Memastikan jenis izin valid
        $allowedAbilities = [
            'can_view',
            'can_create',
            'can_edit',
            'can_delete',
        ];

        if (!in_array($ability, $allowedAbilities, true)) {
            abort(403, 'Jenis izin tidak valid.');
        }

        // Mengambil role pengguna yang login
        $user = Auth::user();
        $role = $user->role;

        if (!$role) {
            abort(403, 'Pengguna belum memiliki role.');
        }

        // Admin mendapatkan akses penuh
        if (strtolower($role->name) === 'admin') {
            return $next($request);
        }

        // Memeriksa apakah menu tersedia dan aktif
        $menu = Menu::where('slug', $menuSlug)
            ->where('is_active', true)
            ->first();

        if (!$menu) {
            abort(403, 'Menu tidak tersedia.');
        }

        // Memeriksa hak akses dari database
        $permission = RoleMenu::where('role_id', $role->id)
            ->where('menu_id', $menu->id)
            ->where($ability, true)
            ->exists();

        // Jika tidak memiliki izin
        if (!$permission) {
            abort(403, 'Kamu tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
