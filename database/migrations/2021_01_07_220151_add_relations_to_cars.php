<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationsToCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {

            $table->dropColumn('makerName');
            $table->dropColumn('modelName');
            $table->dropColumn('ManufacturingYear');

            $table->text('ServiceHistory');
            $table->string('lat')->default(null);
            $table->string('lng')->default(null);
            $table->string('phone')->nullable();

            $table->string('InstallmentMonth');
            $table->string('InstallmentPrice');
            $table->string('InstallmentCurrency');

            $table->boolean("Deposit")->default(0);
            $table->string('DepositPrice');
            $table->string('DepositCurrency');


            $table->bigInteger('Country_id')->unsigned();
            $table->foreign('Country_id')
            ->references('id')->on('countries')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('City_id')->unsigned();
            $table->foreign('City_id')
            ->references('id')->on('cities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('Governorate_id')->unsigned();
            $table->foreign('Governorate_id')
            ->references('id')->on('governorates')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarMaker_id')->unsigned();
            $table->foreign('CarMaker_id')
            ->references('id')->on('car_makers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarModel_id')->unsigned();
            $table->foreign('CarModel_id')
            ->references('id')->on('car_models')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarBody_id')->unsigned();
            $table->foreign('CarBody_id')
            ->references('id')->on('car_bodies')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarYear_id')->unsigned();
            $table->foreign('CarYear_id')
            ->references('id')->on('car_years')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarCapacity_id')->unsigned();
            $table->foreign('CarCapacity_id')
            ->references('id')->on('car_capacities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('CarColor_id')->unsigned();
            $table->foreign('CarColor_id')
            ->references('id')->on('car_colors')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->integer('views');

            $table->boolean('AccidentBefore')->default(0);

            $table->integer("transmission")->default(0);

            $table->integer('price')->change();
            $table->integer('PrePrice')->change();
            $table->integer('payment')->default(0);
            $table->integer('status')->change()->default(0);
            $table->integer('SellerType')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['Country_id']);
            $table->dropForeign(['City_id']);
            $table->dropForeign(['Governorate_id']);
            $table->dropForeign(['CarColor_id']);
            $table->dropForeign(['CarCapacity_id']);
            $table->dropForeign(['CarYear_id']);
            $table->dropForeign(['CarModel_id']);
            $table->dropForeign(['CarBody_id']);
            $table->dropForeign(['CarMaker_id']);
            $table->dropForeign(['Feature_id']);
            $table->dropForeign(['Badge_id']);

            // 2. Drop the column

            $table->dropColumn('ServiceHistory');
            $table->dropColumn('SellerType');
            $table->dropColumn('payment');
            $table->dropColumn('status');
            $table->dropColumn('transmission');
            $table->dropColumn('AccidentBefore');
            $table->dropColumn('views');
            $table->dropColumn('PrePrice');
            $table->dropColumn('price');
            $table->dropColumn('phone');
            $table->dropColumn('lng');
            $table->dropColumn('lat');
            $table->dropColumn('DepositCurrency');
            $table->dropColumn('DepositPrice');
            $table->dropColumn('Deposit');
            $table->dropColumn('InstallmentMonth');
            $table->dropColumn('InstallmentPrice');
            $table->dropColumn('InstallmentCurrency');


        });
    }
}
