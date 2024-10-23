<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userRoles()
    {
        return $this->belongsToMany(UserRole::class, 'users_to_roles');
    }

    public function checkRoles($userRoles)
    {
        if (!is_array($userRoles)) {
            $userRoles = [$userRoles];
        }

        if (!$this->hasAnyRole($userRoles)) {
            auth()->logout();
            abort(404);
        }
    }

    public function hasAnyRole($userRoles): bool
    {
        return (bool) $this->userRoles()->whereIn('user_role', $userRoles)->first();
    }

    public function hasRole($userRoles): bool
    {
        return (bool) $this->userRoles()->where('user_role', $userRoles)->first();
    }
}
