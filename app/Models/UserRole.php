<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    public static $USER_ROLE_DICT = [
        'ADMINISTRATOR', 'GUEST'
    ];

    public function scopeAdministratorRole($query)
    {
        return $query->where('user_role', self::$USER_ROLE_DICT[0])->first();
    }

    public function scopeGuestRole($query)
    {
        return $query->where('user_role', self::$USER_ROLE_DICT[1])->first();
    }

    public function roles()
    {
        return $this->belongsToMany(User::class, 'users_to_roles');
    }
}
