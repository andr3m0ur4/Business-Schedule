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
        Schema::create('tv_shows_times', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->time('final_time');
            $table->date('date');
            $table->tinyInteger('week_day');
            $table->enum('mode', ['Ao Vivo', 'Gravado', 'Unidade Móvel']);
            $table->unsignedBigInteger('tv_show_id');
            $table->unsignedBigInteger('switcher_id');
            $table->unsignedBigInteger('studio_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tv_show_id')->references('id')->on('tv_shows');
            $table->foreign('switcher_id')->references('id')->on('switchers');
            $table->foreign('studio_id')->references('id')->on('studios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tv_shows_times', function(Blueprint $table) {
            $table->dropForeign('tv_shows_times_tv_show_id_foreign');
            $table->dropForeign('tv_shows_times_switcher_id_foreign');
            $table->dropForeign('tv_shows_times_studio_id_foreign');
        });

        Schema::dropIfExists('tv_shows_times');
    }
};
