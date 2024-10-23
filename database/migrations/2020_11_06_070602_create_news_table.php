<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('news', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->text('title');
        //     $table->date('posting_date');
        //     $table->string('image');
        //     $table->text('thread');

        //     $table->unsignedBigInteger('category_id')->index();
        //     $table->foreign('category_id')->references('id')->on('categories');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('news');
    }
}
