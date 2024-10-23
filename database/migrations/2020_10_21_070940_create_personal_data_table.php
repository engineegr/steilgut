<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps(); // craeted_at / updated_at
            $table->timestamp('invalid_date')->nullable(); // personal_data is no longer valid

            $table->string('lfp');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('initials')->nullable();
            $table->datetime('birthday')->nullable();

            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_data');
    }
}
