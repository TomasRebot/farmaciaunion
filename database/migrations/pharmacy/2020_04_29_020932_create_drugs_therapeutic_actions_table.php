<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugsTherapeuticActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('drugs_therapeutic_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('therapeutic_action_id');
            $table->unsignedBigInteger('drug_id');

            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('therapeutic_action_id')->references('id')
                ->on('therapeutic_actions');
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
        Schema::dropIfExists('drugs_therapeutic_actions');
    }
}
