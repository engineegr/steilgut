<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Person;

class PersonalData extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "lfp", 'first_name', 'last_name', 'initials', 'birthday'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
