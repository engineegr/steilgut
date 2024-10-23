<?php

namespace App\Services;

use App\Traits\ConsumeExternalServices;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Log;

class StripeService
{

    use ConsumeExternalServices;

    public $baseUri;
    public $key;
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }


    public function handlePayment(Request $request, $validPaymentData)
    {
        $validPaymentMethodData = $request->validate([
            'payment.payment_method' => 'required',
        ]);

        $paymentMethod = $validPaymentMethodData['payment']['payment_method'];
        $intent = $this->createIntent($validPaymentData['currency'], $validPaymentData['value'], $paymentMethod);
        return [
            "data" => [
                'approvalURL' => '/api/payments/approval',
                'paymentMethodId' => $intent->id,
            ],
            "status" => 200, // OK
        ];
    }

    public function handleApproval(Request $request)
    {
        $validRequestParameterData = $request->validate([
            'payment_method_id' => 'required|string',
        ]);
        $paymentMethodId = $validRequestParameterData['payment_method_id'];
        $confirmation = $this->confirmPayment($paymentMethodId);

        if ($confirmation->status === 'requires_action') {
            $clientSecret = $confirmation->client_secret;

            return [
                "data" => [
                    'payment_method_id' => $paymentMethodId,
                    'client_secret' => $clientSecret,
                    'service_key' => config('services.stripe.key'),
                    'is_stripe_3dsecure' => true,
                ],
                "status" => 200,
            ];
        }

        if ($confirmation->status === 'succeeded') {
            $name = $confirmation->charges->data[0]->billing_details->name;
            $currency = strtoupper($confirmation->currency);
            $amount = $confirmation->amount / $this->calcZeroDecimalCurrencyFactor($currency);

            return [
                "data" => [
                    'withSuccess' => __('order.successfulPaymentText', [
                        'name' => $name,
                        'amount' => $amount,
                        'currency' => $currency,
                    ])
                ],
                "status" => 200, // OK
            ];
        }

        // no approval
        return [
            "errors" => [
                "500" => __('order.failedPaymentText'),
            ],
            "status" => 500,
        ];
    }

    public function createIntent($currency, $value, $paymentMethod)
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            [],
            [
                'amount' => round($value * $this->calcZeroDecimalCurrencyFactor($currency)),
                'currency' => strtolower($currency),
                'payment_method' => $paymentMethod,
                'confirmation_method' => 'manual',
            ],
        );
    }

    public function confirmPayment($paymentIntentId)
    {
        return $this->makeRequest(
            'POST',
            "/v1/payment_intents/{$paymentIntentId}/confirm",
        );
    }

    private function resolveAccessToken()
    {
        return "Bearer {$this->secret}";
    }

    private function calcZeroDecimalCurrencyFactor($currency)
    {
        $zeroDecimalCurrencyList = ['JPY'];

        if (in_array(strtoupper($currency), $zeroDecimalCurrencyList)) {
            return 1;
        }

        return 100;
    }
}
