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
