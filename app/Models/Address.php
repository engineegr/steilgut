<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Person;

class Address extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_path', 'google_place_id',
        'country', 'county', 'city', 'street',
        'building_number', 'flat_number', 'zip_code',
        'organization_title'
    ];

    public function orderData()
    {
        /*
         * Link: https://laravel.com/docs/8.x/eloquent-relationships#one-to-many 
         * Like the hasOne method, you may also override the foreign and local keys by passing additional arguments to
         * the hasMany method 
         */
        return $this->hasMany(OrderData::class);
    }

    public function isCountryOnly()
    {
        return $this->country && !($this->full_path &&  $this->google_place_id && $this->county
            && $this->city && $this->street && $this->building_number && $this->flat_number && $this->zip_code && $this->organization_title);
    }

    public function getAddressStr()
    {
        $addressStr = $this->country;
        if ($this->full_path) {
            $addressStr = $this->full_path;
        } else {
            if ($this->county) {
                $addressStr += ', ' . $this->county;
            }

            if ($this->city) {
                $addressStr += ', ' . $this->city;
            }

            if ($this->street) {
                $addressStr += ', ' . $this->street;
            }

            if ($this->building_number) {
                $addressStr += ', ' . $this->building_number;
            }

            if ($this->flat_number) {
                $addressStr += ', ' . $this->flat_number;
            }

            if ($this->zip_code) {
                $addressStr += ', ' . $this->zip_code;
            }

            if ($this->organization_title) {
                $addressStr += ', ' . $this->organization_title;
            }
        }
        return $addressStr;
    }
}
