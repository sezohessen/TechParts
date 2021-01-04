<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar');
            $table->text('description');
            $table->text('description_ar');

            $table->bigInteger('img_id')->unsigned();
            $table->foreign('img_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('insurance_id')->unsigned();
            $table->foreign('insurance_id')
            ->references('id')->on('insurances')
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
        Schema::dropIfExists('insurance_offers');
    }
}
