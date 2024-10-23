<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('country');
            $table->string('full_path')->nullable();
            $table->string('google_place_id')->nullable();
            $table->string('county')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('building_number')->nullable();
            $table->string('flat_number')->nullable();;
            $table->string('zip_code')->nullable();
            $table->string('organization_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
