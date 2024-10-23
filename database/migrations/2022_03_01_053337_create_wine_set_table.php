<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineSetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_set', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->mediumInteger('min_harvest');
            $table->mediumInteger('max_harvest');
            $table->mediumInteger('count');
            $table->float('price');
            $table->text('terroir')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_set');
    }
}
