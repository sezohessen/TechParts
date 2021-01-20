<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promote_cars', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('car_id')->unsigned();
            $table->foreign('car_id')
            ->references('id')->on('cars')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->bigInteger('subscribe_package_id')->unsigned();
            $table->foreign('subscribe_package_id')
            ->references('id')->on('subscribe_packages')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->string("price");

            $table->string("weaccept_order_id");

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
        Schema::dropIfExists('promote_cars');
    }
}
