<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->bigInteger('CarModel_id')->unsigned();
            $table->foreign('CarModel_id')
            ->references('id')->on('car_models')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarMaker_id')->unsigned();
            $table->foreign('CarMaker_id')
            ->references('id')->on('car_makers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarYear_id')->unsigned();
            $table->foreign('CarYear_id')
            ->references('id')->on('car_years')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarCapacity_id')->unsigned();
            $table->foreign('CarCapacity_id')
            ->references('id')->on('car_capacities')
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
        Schema::dropIfExists('cars');
    }
}
