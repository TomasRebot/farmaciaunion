<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('direction');
            $table->string('high');
            $table->string('floor');
            $table->string('phone');
            $table->string('apartment');
            $table->unsignedBigInteger('location_id');
            $table->enum('state', [1,0])->default(1);

            $table->foreign('location_id')->references('id')->on('locations');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
