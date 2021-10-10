<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');



            $table->bigInteger('bg')->unsigned()->nullable();
            $table->foreign('bg')
            ->references('id')->on('images')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->bigInteger('avatar')->unsigned()->nullable();
            $table->foreign('avatar')
            ->references('id')->on('images')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->text('desc')->nullable();
            $table->text('desc_ar')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->text('street')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('file')->nullable();

            $table->bigInteger('governorate_id')->unsigned()->nullable();
            $table->foreign('governorate_id')
            ->references('id')->on('governorates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
            ->references('id')->on('cities')
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
        Schema::dropIfExists('sellers');
    }
}
