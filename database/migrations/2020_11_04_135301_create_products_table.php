<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->morphs('productable');
            $table->decimal('discount', 7, 4)->default('0.0');

            /* Total of the product stored in stock */
            $table->mediumInteger('total_in_stock')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('products');
        // Schema::enableForeignKeyConstraints();
    }
}
