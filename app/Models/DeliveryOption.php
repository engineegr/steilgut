<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    use HasFactory;

    public static $DELIVERY_OPTION_DICT = [
        'SELF_DELIVERY', 'COURIER_DELIVERY', 'POST_DELIVERY'
    ];

    public function orderData()
    {
        return $this->hasMany(OrderData::class);
    }

    public function scopeSelfDeliveryOption($query)
    {
        return $query->where('delivery_option', self::$DELIVERY_OPTION_DICT[0])->first();
    }

    public function scopeCourierDeliveryOption($query)
    {
        return $query->where('delivery_option', self::$DELIVERY_OPTION_DICT[1])->first();
    }

    public function scopePostDeliveryOption($query)
    {
        return $query->where('delivery_option', self::$DELIVERY_OPTION_DICT[2])->first();
    }

    public function getDeliveryStr()
    {
        $deliveryStr = __('order.unknownStatus');
        switch ($this->delivery_option) {
            case 'SELF_DELIVERY':
                $deliveryStr = __('order.wineryDeliveryHeader');
                break;

            case 'COURIER_DELIVERY':
                $deliveryStr = __('order.courierDeliveryHeader');
                break;

            case 'POST_DELIVERY':
                $deliveryStr = __('order.mailDeliveryHeader');
                break;
        }

        return $deliveryStr;
    }
}
