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
        Schema::create('tv_show_times', function (Blueprint $table) {
            $table->string('id', 100)->primary();
            $table->time('start_time');
            $table->time('final_time');
            $table->date('date');
            $table->tinyInteger('week_day');
            $table->enum('mode', ['Ao Vivo', 'Gravado', 'Externa']);
            $table->foreignId('switcher_id')->constrained();
            $table->foreignId('studio_id')->constrained();
            $table->foreignId('tv_show_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tv_show_times');
    }
};
