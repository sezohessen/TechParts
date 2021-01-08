<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar');
            $table->text('description');
            $table->text('description_ar');
            $table->integer('price');

            $table->bigInteger('insurance_id')->unsigned();
            $table->foreign('insurance_id')
            ->references('id')->on('insurances')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('offer_id')->unsigned();
            $table->foreign('offer_id')
            ->references('id')->on('insurance_offers')
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
        Schema::dropIfExists('offer_plans');
    }
}
