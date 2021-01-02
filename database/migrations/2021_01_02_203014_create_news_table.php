<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_ar');
            $table->string('authorName');

            $table->bigInteger('authorImg_id')->unsigned();
            $table->foreign('authorImg_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('image_id')->unsigned();
            $table->foreign('image_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->text('description');
            $table->text('description_ar');
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
        Schema::dropIfExists('news');
    }
}
