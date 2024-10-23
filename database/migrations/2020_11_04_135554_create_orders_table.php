<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->primary(['product_id', 'order_data_id']);
            $table->timestamps();

            // Product quantity
            $table->mediumInteger('subtotal')->default(0);

            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_data_id')->constrained('order_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
