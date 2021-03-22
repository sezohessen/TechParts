<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_requests', function (Blueprint $table) {
            $table->id();
            $table->boolean('self_employed')->default(0);
            $table->boolean('salary_through_bank')->default(0);
            $table->string('monthly_salary');
            $table->boolean('paid_loan')->default(0);
            $table->boolean('existing_loans')->default(0);
            $table->string('provide_amount')->nullable();
            $table->boolean('existing_credit')->default(0);
            $table->string('status');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('bank_name')->nullable();

            $table->bigInteger('car_id')->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->bigInteger('offer_id')->nullable();
            $table->bigInteger('insurance_company_id')->nullable();
            $table->bigInteger('plan_id')->nullable();


            $table->bigInteger('car_makerId')->unsigned();
            $table->foreign('car_makerId')
            ->references('id')->on('car_makers')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('car_modelId')->unsigned();
            $table->foreign('car_modelId')
            ->references('id')->on('car_models')
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
        Schema::dropIfExists('finance_requests');
    }
}
