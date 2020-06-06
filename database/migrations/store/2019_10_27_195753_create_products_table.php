<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->text('bar_code');
            $table->string('merlin_id')->nullable()->default(null)->index();
            $table->text('die_number')->nullable()->default(null);
            $table->string('presentation')->nullable()->default(null);
            $table->string('fragment_unit')->nullable()->default(null);
            $table->float('price')->nullable()->default(null);
            $table->enum('state', [1,0])->default(1);
            $table->bigInteger('stock')->default(0);

            $table->unsignedBigInteger('provider_id')->nullable()->default(null);
            $table->unsignedBigInteger('brand_id')->nullable()->default(null);
            $table->unsignedBigInteger('category_id')->nullable()->default(null);;
            $table->unsignedBigInteger('laboratory_id')->nullable()->default(null);
            $table->unsignedBigInteger('drug_id')->nullable()->default(null);
            $table->unsignedBigInteger('primary_therapeutic_action_id')->nullable()->default(null);

            $table->timestamps();
            //relationships
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');
            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('primary_therapeutic_action_id')->references('id')->on('therapeutic_actions');
        });
//        DB::statement('ALTER TABLE products CHANGE bar_code bar_code INT(10) UNSIGNED ZEROFILL NOT NULL');
//        DB::statement('ALTER TABLE products CHANGE merlin_id merlin_id INT(10) UNSIGNED ZEROFILL NOT NULL');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
