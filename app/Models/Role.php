<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // relasi ke hak akses menu
    public function roleMenus(): HasMany
    {
        return $this->hasMany(RoleMenu::class);
    }
}
