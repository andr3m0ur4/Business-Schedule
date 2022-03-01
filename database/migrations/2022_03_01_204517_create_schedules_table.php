<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tv_show_time_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('tv_show_time_id')->references('id')->on('tv_shows_times');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function(Blueprint $table) {
            $table->dropForeign('schedules_tv_show_time_id_foreign');
            $table->dropForeign('schedules_user_id_foreign');
        });

        Schema::dropIfExists('schedules');
    }
};
