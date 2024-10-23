<?php

namespace App\Services;

use App\Traits\ConsumeExternalServices;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use Log;

class PayPalService
{

    use ConsumeExternalServices;

    protected $baseUri;
    protected $clientId;
    protected $clientSecret;

    public function __construct()
    {
        $this->baseUri = config('services.paypal.base_uri');
        $this->clientId = config('services.paypal.client_id');
        $this->clientSecret = config('services.paypal.client_secret');
    }

    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
        $headers['Content-Type'] = 'application/json';
        // print_r($headers );
    }

    public function decodeResponse($response)
    {
        return json_decode($response);
    }

    public function handlePayment(Request $request)
    {
        $order = $this->createOrder($request['currency'], $request['value']);

        $orderLinks = collect($order->links);

        session()->put('paypal_approved_id', $order->id);

        $approvalLink = $orderLinks->where('rel', 'approve')->first();

        return redirect($approvalLink->href);
    }

    public function handleApproval()
    {
        if (session()->has('paypal_approved_id')) {
            $approvedId = session()->get('paypal_approved_id');

            $payment = $this->capturePayment($approvedId);

            $name = $payment->payer->name->given_name;
            $payment = $payment->purchase_units[0]->payments->captures[0]->amount;
            $amount = $payment->value;
            $currency = $payment->currency_code;

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

        return [
            "errors" => [
                "500" => __('order.failedPaymentText'),
            ],
            "status" => 500,
        ];
    }

    public function createOrder($currency, $value)
    {
        $factor = $this->calcZeroDecimalCurrencyFactor($currency);

        return $this->makeRequest(
            'POST',
            '/v2/checkout/orders',
            [
                'debug' => true,
            ], // query params
            [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    0 => [
                        'amount' => [
                            'currency_code' => strtoupper($currency),
                            'value' => round($value * $factor) / $factor,
                        ],
                    ]
                ],
                'application_context' => [
                    'brand_name' => config("app.name"),
                    'shipping_preference' => 'NO_SHIPPING',
                    'locale' => 'ru-RU',
                    'user_action' => 'PAY_NOW',
                    'return_url' => route('approval'),
                    'cancel_url' => route('cancellation'),
                ]

            ], // form_params 
            [], // headers
            $isJsonRequest = true // isJson
        );
    }

    public function capturePayment($approveId)
    {
        return $this->makeRequest(
            'POST',
            "/v2/checkout/orders/{$approveId}/capture",
            [],
            [],
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    private function resolveAccessToken()
    {
        Log::info("Info [PayPalService->resolveAccessToken] enter the method");
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        // use access-token 
        $client = new Client();
        $response = $client->request(
            'POST',
            'https://api.sandbox.paypal.com/v1/oauth2/token',
            array(
                'headers' => [
                    'Accept'     => 'application/json',
                    'Accept-Language' => 'en_US',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => "Basic {$credentials}"
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ),
        );
        $data = json_decode($response->getBody(), true);

        // print_r($data);
        // print_r($data["access_token"]);


        return "Bearer {$data["access_token"]}";
        // return "Basic {$credentials}";
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
