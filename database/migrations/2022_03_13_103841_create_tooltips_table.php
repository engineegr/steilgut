<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTooltipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tooltips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('announcement');
            $table->string('image');
            
            $table->morphs('tooltipable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tooltips');
    }
}
