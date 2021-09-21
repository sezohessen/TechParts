<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('part_imgs', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('part_id')->unsigned();
            $table->foreign('part_id')
            ->references('id')->on('parts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('img_id')->unsigned()->nullable();
            $table->foreign('img_id')
            ->references('id')->on('images')
            ->onDelete('set null')
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
        Schema::dropIfExists('part_imgs');
    }
}
