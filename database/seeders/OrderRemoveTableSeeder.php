<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\OrderData;

class OrderRemoveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $orderData = OrderData::whereNotNull('id')->first();
            if ($orderData) {
                foreach ($orderData->products as $product) {
                    $product->total_in_stock += $orderData->subtotal;
                    $product->orders()->detach($orderData->id);
                    $product->save();
                }
                $person = $orderData->person;
                $orderData->delete();
                $person->delete();
            }
            DB::commit();
        } catch (\PDOException $ex) {
            DB::rollback();
        }
    }
}
