<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_imgs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('car_id')->unsigned();
            $table->foreign('car_id')
            ->references('id')->on('cars')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('img_id')->unsigned();
            $table->foreign('img_id')
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
        Schema::dropIfExists('car_imgs');
    }
}
