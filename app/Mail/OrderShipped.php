<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\OrderData;
use Illuminate\Support\Facades\App;

class OrderShipped extends Mailable // implements ShouldQueue
{
    use Queueable, SerializesModels;

    private OrderData $orderData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderData)
    {
        $this->orderData = $orderData;
        $this->onConnection('database')->onQueue('default');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paymentOptionStr = $this->orderData->getPaymentOption();
        $orderNumberStr = $this->orderData->id;
        $p = $this->orderData->person;
        $pd = $p->personalData;
        $phone = $p->phones[0]->phone_number;
        $email = $p->email;
        $price = number_format($this->orderData->subtotal_price, 2, ',');
        $deliveryPrice = number_format($this->orderData->delivery_price, 2, ',');
        $summary = number_format(($this->orderData->subtotal_price + $this->orderData->delivery_price), 2, ',');

        if ($this->orderData->deliveryOption->id === 1) { // Take the order from the winery
            $address = "";
        } else {
            $address = $this->orderData->address;
        }

        $country = $address->country;
        $zipCode = $address->zip_code;
        $delivery = $this->orderData->deliveryOption;
        $status = $this->orderData->getLocaleStatus();
        $addressStr = $address->getAddressStr();
        $deliveryStr = $delivery->getDeliveryStr();

        $productList = $this->orderData->products;

        $localeStr = App::getLocale();
        $buildingMail = $this->subject('Steilgut Order # ' . $orderNumberStr)->with([
            'createdAt' => $this->orderData->created_at,
            'paymentOption' => $paymentOptionStr,
            'orderNumberStr' => $orderNumberStr,
            'LFP' => $pd->lfp,
            'phone' => $phone,
            'price' => $price,
            'deliveryPrice' => $deliveryPrice,
            'summary' => $summary,
            'country' => $country,
            'address' => $addressStr,
            'zipCode' => $zipCode,
            'email' => $email,
            'delivery' => $deliveryStr,
            'status' => $status,
            'productList' => $productList,
            'orderData' => $this->orderData
        ]);

        switch ($localeStr) {
            case 'de':
                $buildingMail = $buildingMail->markdown('email.order-finallization.to-user-order-notification-de-new');
                break;

            case 'ru':
                $buildingMail = $buildingMail->markdown('email.order-finallization.to-user-order-notification-ru-new');
                break;

            default:
                $buildingMail = $buildingMail->markdown('email.order-finallization.to-user-order-notification-de-new');
                break;
        }

        return $buildingMail;
    }
}
