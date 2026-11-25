<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleMenuController extends Controller
{
    // menampilkan halaman pengaturan hak akses
    public function index(Request $request)
    {
        // mengambil role selain admin
        $roles = Role::where('name', '!=', 'admin')->get();

        // mengambil role yang dipilih
        $selectedRole = $request->role_id
            ? Role::where('name', '!=', 'admin')
            ->findOrFail($request->role_id)
            : $roles->first();

        // mengambil menu beserta hak akses role
        $menus = $selectedRole
            ? Menu::with(['roleMenus' => function ($query) use ($selectedRole) {
                $query->where('role_id', $selectedRole->id);
            }])->get()
            : collect();

        return view('admin.hak-akses.index', compact(
            'roles',
            'selectedRole',
            'menus'
        ));
    }

    // menyimpan perubahan hak akses
    public function update(Request $request, Role $role)
    {
        // admin tidak boleh diubah melalui halaman ini
        abort_if(
            strtolower($role->name) === 'admin',
            403,
            'Admin tidak dapat diubah'
        );

        // validasi data
        $validated = $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['array'],
            'permissions.*.can_view' => ['sometimes', 'boolean'],
            'permissions.*.can_create' => ['sometimes', 'boolean'],
            'permissions.*.can_edit' => ['sometimes', 'boolean'],
            'permissions.*.can_delete' => ['sometimes', 'boolean'],
        ]);

        DB::transaction(function () use ($role, $validated) {
            $menus = Menu::all();

            foreach ($menus as $menu) {
                $permission = $validated['permissions'][$menu->id] ?? [];

                RoleMenu::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'menu_id' => $menu->id,
                    ],
                    [
                        'can_view' => $permission['can_view'] ?? false,
                        'can_create' => $permission['can_create'] ?? false,
                        'can_edit' => $permission['can_edit'] ?? false,
                        'can_delete' => $permission['can_delete'] ?? false,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.dashboard', [
                'role_id' => $role->id
            ])
            ->with('success', 'Role menu berhasil diperbarui.');
    }
}
