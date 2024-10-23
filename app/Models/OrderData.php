<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderData extends Model
{
    use HasFactory;

    protected $fillable = ['subtotal_price', 'delivery_price'];

    public function person()
    {
        // person_id - second param, third param could be 'id' of parent entity
        // see https://laravel.com/docs/8.x/eloquent-relationships#one-to-many
        return $this->belongsTo(Person::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function state()
    {
        /*
        * To remove the state from order we must use dissociation.
        *
        * When removing a belongsTo relationship, you may use the dissociate method. 
        * This method will reset the foreign key as well as the relation on the child model:

        * $order->state()->dissociate();
        * $order->save();
        * Link: https://laravel.com/docs/8.x/eloquent-relationships
        */
        return $this->belongsTo(State::class);
    }

    public function deliveryOption()
    {
        return $this->belongsTo(DeliveryOption::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orders')->withPivot('subtotal');
    }

    public function getSubtotal($productId)
    {
        foreach ($this->products as $product) {
            if ($product->id === $productId) {
                return $product->pivot->subtotal;
            }
        }

        return -1;
    }

    public function getSummaryPrice()
    {
        $summary = 0;

        foreach ($this->products as $product) {
            $price = $product->productable->price * $this->getSubtotal($product->id);
            if ($product->discount !== 0.0) {
                $summary += round($price - $price * $product->discount);
            } else {
                $summary += $price;
            }
        }

        return $summary;
    }

    public function getSummaryPriceById($productId)
    {
        foreach ($this->products as $product) {
            if ($product->id === $productId) {
                $price = $product->productable->price * $this->getSubtotal($product->id);
                if ($product->discount !== 0.0) {
                    return number_format($price - $price * $product->discount, 1, ',');
                } else {
                    return number_format($price, 1, ',');
                }
            }
        }

        return number_format(0, 1, ',');
    }


    public function getLocaleStatus()
    {
        switch ($this->state->id) {
            case 1:
                return __("order.openStatus");
                break;

            case 2:
                return __("order.paiedStatus");
                break;

            case 3:
                return __("order.closedStatus");
                break;

            default:
                return __("order.unknownStatus");
                break;
        }
    }

    public function getPaymentOption() {
        if ($this->state->id === 2) { // Payed
            return __("order.cardPaymentHeader");
        }
        return __("order.bankAccountPaymentHeader");
    }
}
