<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRolePermissionsForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permissions_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('form_id');

            //relationships
            $table->foreign('role_id')->references('id')
                ->on('roles')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('permission_id')->references('id')
                ->on('permissions')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('form_id')->references('id')
                ->on('forms')->onDelete('cascade')
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
        Schema::dropIfExists('role_permissions_forms');
    }
}
