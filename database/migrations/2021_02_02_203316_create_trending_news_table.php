<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrendingNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trending_news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trend_id')->unsigned();
            $table->foreign('trend_id')
            ->references('id')->on('news_days')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('news_id')->unsigned();
            $table->foreign('news_id')
            ->references('id')->on('news')
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
        Schema::dropIfExists('trending_news');
    }
}
