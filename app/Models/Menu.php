<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $table = "menus";

    protected $fillable = [
        'nama_menu',
        'slug',
        'route',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // relasi ke role_menu
    public function roleMenus(): HasMany
    {
        return $this->hasMany(RoleMenu::class);
    }

    // relasi ke menu induk
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // relasi submenu
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
