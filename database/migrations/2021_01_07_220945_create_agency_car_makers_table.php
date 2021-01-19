<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyCarMakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_car_makers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('CarMaker_id')->unsigned();
            $table->foreign('CarMaker_id')
            ->references('id')->on('car_makers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('agency_id')->unsigned();
            $table->foreign('agency_id')
            ->references('id')->on('agencies')
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
