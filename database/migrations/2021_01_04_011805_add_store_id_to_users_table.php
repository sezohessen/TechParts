<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->bigInteger('image_id')->nullable()->unsigned();
            $table->foreign('image_id')
            ->references('id')->on('images')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country_code');
            $table->string('country_phone');
            $table->string('interest_country')->default(0);
            $table->boolean('is_phone_virefied')->default(0);
            $table->string('phone')->unique();
            $table->string('whats_app')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['image_id']);

            // 2. Drop the column
            $table->dropColumn('image_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('country_code');
            $table->dropColumn('country_phone');
            $table->dropColumn('is_phone_virefied');
            $table->dropColumn('phone');
            $table->dropColumn('whats_app');
            $table->dropColumn('interest_country');
            $table->string('name');
        });
    }
}
