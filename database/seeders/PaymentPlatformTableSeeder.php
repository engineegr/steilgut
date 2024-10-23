<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentPlatform;

class PaymentPlatformTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentPlatform::create([
            'name' => 'PayPal',
            'image' => '/images/icons/payment-platforms/paypal.jpg',
        ]);

        PaymentPlatform::create([
            'name' => 'Stripe',
            'image' => '/images/icons/payment-platforms/stripe.jpg',
        ]);
    }
}
