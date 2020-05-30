<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGlobalConfigs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('global_configs', function (Blueprint $table) {
            $table->id();

            $table->string('bussines_name')->nullable()->default(null);
            $table->text('bussines_description')->nullable()->default(null);
            $table->string('schedule_time')->nullable()->default(null);
            $table->string('fix_phone')->nullable()->default(null);
            $table->string('bussiness_schedule')->nullable()->default(null);
            $table->string('whatsapp_phone')->nullable()->default(null);
            $table->text('pixel_facebook')->nullable()->default(null);
            $table->text('google_analitycs')->nullable()->default(null);

            $table->string('facebook_link')->nullable()->default(null);
            $table->string('instagram_link')->nullable()->default(null);
            $table->string('twitter_link')->nullable()->default(null);
            $table->string('youtube_link')->nullable()->default(null);
            $table->string('linkedin_link')->nullable()->default(null);
            $table->string('data_fiscal_link')->nullable()->default(null);

            $table->string('login_logo')->nullable()->default(null);
            $table->string('email_sender')->nullable()->default(null);
            $table->string('email_reciver')->nullable()->default(null);
            $table->string('email_suport')->nullable()->default(null);

            $table->unsignedBigInteger('address_id')->nullable()->default(null);
            $table->foreign('address_id')->references('id')->on('addresses');
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
        Schema::dropIfExists('table_global_configs');
    }
}
