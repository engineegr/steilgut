<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSteilgutHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steilgut_history', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->char('year', 4);

            // xs - min-width = 320px
            $table->string('xs_image')->nullable();
            $table->string('xs_2x_image')->nullable();

            // sm - min-width = 640px
            $table->string('sm_image')->nullable();
            $table->string('sm_2x_image')->nullable();

            // md - min-width = 768px
            $table->string('md_image')->nullable();
            $table->string('md_2x_image')->nullable();

            // lg - min-width = 1024px
            $table->string('lg_image')->nullable();
            $table->string('lg_2x_image')->nullable();

            // hd - min-width = 1280px
            $table->string('hd_image');
            $table->string('hd_2x_image');

            $table->text('thread');

            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steilgut_history');
    }
}
