<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_reviews', function (Blueprint $table) {
            $table->id();
            $table->enum ('rate', ['1', ' 2', ' 3', ' 4', ' 5'] );
            $table->enum ('price', ['1', ' 2', ' 3'] );
            $table->text('review');
            $table->boolean('active')->default(0);
            $table->bigInteger('agency_id')->unsigned();
            $table->foreign('agency_id')
            ->references('id')->on('agencies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::dropIfExists('agency_reviews');
    }
}
