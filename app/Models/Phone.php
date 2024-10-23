<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use User;

class Phone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone_number'
    ];


    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
