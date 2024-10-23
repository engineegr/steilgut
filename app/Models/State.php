<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public static $ORDER_STATUS_DICT = [
        'OPEN', 'PAYED', 'CLOSED'
    ];

    public function orderData()
    {
        return $this->hasMany(OrderData::class);
    }

    public function scopeOrderOpenStatus($query)
    {
        return $query->where('status', self::$ORDER_STATUS_DICT[0])->first();
    }

    public function scopeOrderPayedStatus($query)
    {
        return $query->where('status', self::$ORDER_STATUS_DICT[1])->first();
    }

    public function scopeOrderClosedStatus($query)
    {
        return $query->where('status', self::$ORDER_STATUS_DICT[2])->first();
    }
}
