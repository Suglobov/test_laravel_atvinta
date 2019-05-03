<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('time_id');
            $table->unsignedInteger('access_id');
            $table->dateTime('time_of_del');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('time_id')->references('id')->on('reference_time');
            $table->foreign('access_id')->references('id')->on('reference_access');
            $table->index('user_id');
            $table->index('time_id');
            $table->index('access_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
