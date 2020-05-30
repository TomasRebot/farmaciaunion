<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('module_id')->nullable()->default(Null);
            $table->string('name');
            $table->string('key');
            $table->string('target');
            $table->string('icon')->default('fa-th-large');
            $table->enum('state', [1,0])->default(1);
            $table->unsignedInteger('order')->default(0);


            //relationships
            $table->foreign('module_id')->references('id')
                ->on('modules')->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('forms');
    }
}
