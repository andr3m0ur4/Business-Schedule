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
        Schema::table('tv_show_times', function(Blueprint $table) {
            $table->dropColumn(['date', 'week_day']);
            $table->renameColumn('start_time', 'start');
            $table->renameColumn('final_time', 'end');
        });

        Schema::table('tv_show_times', function(Blueprint $table) {
            $table->dateTime('start')->change();
            $table->dateTime('end')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tv_show_times', function(Blueprint $table) {
            $table->date('date')->nullable();
            $table->tinyInteger('week_day')->nullable();
            $table->renameColumn('start', 'start_time');
            $table->renameColumn('end', 'final_time');
        });

        Schema::table('tv_show_times', function(Blueprint $table) {
            $table->id()->change();
            $table->time('start_time')->change();
            $table->time('final_time')->change();
        });
    }
};
