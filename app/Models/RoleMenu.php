<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;
use App\Models\Menu;

class RoleMenu extends Model
{
    protected $table = "role_menus";

    protected $fillable = [
        'role_id',
        'menu_id',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete',
    ];

    // relasi ke role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
