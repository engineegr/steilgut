<?php

namespace App\Resolvers;

use App\Models\PaymentPlatform;

class PaymentPlatformResolver {

    private $paymentPlatformList;

    public function __construct()
    {
        $this->paymentPlatformList = PaymentPlatform::get();
    }

    public function resolveService($paymentPlatformId) {

        $name = strtolower(PaymentPlatform::firstWhere('id', $paymentPlatformId)->name);

        $serviceClass = config("services.{$name}.class");

        if($serviceClass) {
            return resolve($serviceClass);
        }

        throw new \Exception("Error! Unknown Payment platform!");
    }

}
