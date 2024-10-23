<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\State;

class OrderStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (State::$ORDER_STATUS_DICT as $status) {
            State::create(['status' => $status]);
        }
    }
}
