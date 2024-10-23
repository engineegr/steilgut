<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryOption;

class DeliveryOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (DeliveryOption::$DELIVERY_OPTION_DICT as $deliveryOption) {
            DeliveryOption::create(['delivery_option' => $deliveryOption]);
        }
    }
}
