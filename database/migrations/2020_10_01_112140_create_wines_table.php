<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->text('wineSort');
            $table->mediumInteger('harvest');
            $table->float('price');
            $table->mediumInteger('volume')->nullable();
            $table->text('wineType')->nullable(); // white or red 
            $table->text('soil')->nullable();
            $table->text('terroir')->nullable();
            $table->mediumInteger('age')->nullable();
            $table->float('residual_sugar')->nullable();
            $table->float('acidity')->nullable();
            $table->float('strength')->nullable();
            $table->text('harvest_aspect')->nullable();
            $table->text('taste')->nullable();
            $table->text('color')->nullable();
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
        Schema::dropIfExists('wines');
    }
}
