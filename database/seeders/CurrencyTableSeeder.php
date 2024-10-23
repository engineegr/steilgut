<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencyList = [
            'RUB',
            'USD',
            'EUR',
        ];

        foreach ($currencyList as $currency) {
            Currency::create([
                'iso' => $currency,
            ]);
        }
    }
}
