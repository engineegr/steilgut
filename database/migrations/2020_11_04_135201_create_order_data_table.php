<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOrderDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->float('subtotal_price');
            $table->float('delivery_price');

            $table->uuid('order_uuid')->default(Str::orderedUuid());
            $table->foreignId('person_id')->contstrained('person');
            $table->foreignId('address_id')->contstrained('address');
            $table->foreignId('state_id')->contstrained('state');
            $table->foreignId('delivery_option_id')->contstrained('deliveryOption');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_data');
    }
}
