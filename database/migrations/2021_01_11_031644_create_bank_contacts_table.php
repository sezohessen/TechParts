<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')
            ->references('id')->on('banks')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('bank_contacts');
    }
}
