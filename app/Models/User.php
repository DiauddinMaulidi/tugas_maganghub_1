<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable =[
        'name',
        'email',
        'password',
        'is_active'
    ];

    protected $hidden =[
        'password',
        'remember_token'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles'
        )->withTimeStamp();
    }
}
