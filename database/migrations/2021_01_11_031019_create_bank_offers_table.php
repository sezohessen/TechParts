<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ar');
            $table->text('description');
            $table->text('description_ar');
            $table->date('valid_till');
            $table->decimal('down_payment_percentage',4,2);
            $table->decimal('interest_rate',4,2);
            $table->integer('number_of_years');
            $table->integer('installment_months');

            $table->bigInteger('logo_id')->unsigned();
            $table->foreign('logo_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('bank_id')->unsigned();
            $table->foreign('bank_id')
            ->references('id')->on('banks')
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
        Schema::dropIfExists('bank_offers');
    }
}
