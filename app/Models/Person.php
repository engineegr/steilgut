<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
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

    public function personalData()
    {
        return $this->hasOne(PersonalData::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function orderData()
    {
        return $this->hasMany(OrderData::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
