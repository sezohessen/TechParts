<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencySpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_specialties', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('specialty_id')->unsigned();
            $table->foreign('specialty_id')
            ->references('id')->on('specialties')
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
        Schema::dropIfExists('agency_specialties');
    }
}
