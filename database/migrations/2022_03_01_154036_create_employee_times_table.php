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
        Schema::create('employee_times', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('final_time');
            $table->date('date');
            $table->tinyInteger('week_day');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::table('employee_times', function(Blueprint $table) {
            $table->dropForeign('employee_times_user_id_foreign');
        });
        
        Schema::dropIfExists('employee_times');
    }
};
