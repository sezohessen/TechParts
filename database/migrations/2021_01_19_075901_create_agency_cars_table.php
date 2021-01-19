<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_cars', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('agency_id')->unsigned();
            $table->foreign('agency_id')
            ->references('id')->on('agencies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('car_id')->unsigned();
            $table->foreign('car_id')
            ->references('id')->on('cars')
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
        Schema::dropIfExists('agency_cars');
    }
}
