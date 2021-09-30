<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('appName');
            $table->string('appName_ar');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instgram')->nullable();
            $table->string('location')->nullable();
            $table->string('andriod')->nullable();
            $table->string('ios')->nullable();
            $table->string('about_us')->nullable();
            $table->string('about_us_ar')->nullable();
            $table->bigInteger('logo_id')->unsigned();
            $table->foreign('logo_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
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
        Schema::dropIfExists('settings');
    }
}
