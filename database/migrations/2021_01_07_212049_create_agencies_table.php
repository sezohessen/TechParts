<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar');
            $table->text('description');
            $table->text('description_ar');
            $table->boolean('show_in_home')->default(0);
            $table->boolean('car_show_rooms')->default(0);
            $table->integer('center_type')->default(0);
            $table->string('lat');
            $table->string('long');
            $table->boolean('car_status')->default(0);
            $table->integer('payment_method')->default(0);
            $table->integer('status')->default(0);
            $table->integer('agency_type')->default(0);
            $table->integer('maintenance_type')->default(0);
            $table->boolean('is_authorised')->default(0);
            $table->boolean('active')->default(1);

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('img_id')->unsigned();
            $table->foreign('img_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')
            ->references('id')->on('countries')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('governorate_id')->unsigned();
            $table->foreign('governorate_id')
            ->references('id')->on('governorates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('city_id')->unsigned();
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
        Schema::dropIfExists('agencies');
    }
}
