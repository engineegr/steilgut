<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackgroundImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('background_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->morphs('imageable');

            /*
            * Backround images directory structure: 
            * [aspect ratio] => [relative path] => [resolution] => <image-file-name>
            */
            $table->string('relative_path');
            $table->string('base_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('background_images');
    }
}
