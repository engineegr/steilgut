<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ValidatorService;
use Log;

class OrderValidatorService
{
    use ValidatorService;

    private $isBankTransfer;

    public function __construct($isBankTransfer)
    {
        $this->isBankTransfer = $isBankTransfer;
    }

    protected function getValidationRuleList()
    {
        $validationRules = [
            'VALID_DELIVERY_OPTIONS' => [
                'delivery_options' => 'required|array|min:3',
                'delivery_options.*' => 'required|boolean',
            ],

            'VALID_CART' => [
                'cart' => 'required|array|min:1',
                'cart.*.id' => 'required|exists:products,id',
            ],

            'VALID_PRICES' => [
                'prices' => 'required|array',
                'prices.subtotal_price' => 'required|numeric|min:0.001',
                'prices.delivery_price' => 'required|numeric|min:0.0',
            ],

            'VALID_PERSONAL_DATA' => [
                'personal_data' => 'required|array',
                'personal_data.lfp' => 'required|string|max:192',
                'personal_data.first_name' => 'nullable|string|max:33',
                'personal_data.lastname_name' => 'nullable|string|max:33',
                'personal_data.phone' => 'nullable|string|max:33',
                'personal_data.email' => 'required|email:rfc,dns|max:33',
                // 'personal_data.phone' => ['present', 'regex:/^([+]?[0-9]{1,2}[ ]?(([(][0-9]{3,4}[)]){1}|([0-9]{3,4}){1})[ \-\s\.]?[0-9]{2,3}[\-\s\.]?[0-9]{4,6}([\-][0-9]{2})?)$/'],
            ],

            'VALID_ADDRESS' => [
                'address' => 'required|array',
                'address.country' => 'required|string|max:192',
                'address.full_path' => 'nullable|string|max:192',
                'address.google_place_id' => 'nullable|string|max:192',
                'address.zip_code' => 'nullable|numeric',
                'address.city' => 'nullable|string|max:192',
                'address.street' => 'nullable|string|max:192',
                'building_number' => 'nullable|string|max:33',
                'county' => 'nullable|string|max:192',
                'organization_title' => 'nullable|string|max:192',
            ]
        ];

        if (!$this->isBankTransfer) {
            $validationRules['VALID_PAYMENT'] = [
                'personal_data' => 'required|array',
                'payment.is_bank_transfer_account' => 'required|boolean',
                'payment.value' => 'required|numeric',
                'payment.currency' => 'required|exists:currencies,iso',
                'payment.payment_platform' => 'exists:payment_platforms,id',
            ];
        }

        return $validationRules;
    }
}
