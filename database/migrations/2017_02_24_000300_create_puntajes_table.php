<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntajes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('query_score')->default(0);
            $table->integer('punish_score')->default(0);
            $table->integer('total_score')->default(0);
            $table->timestamp('time_finish')->nullable();
            $table->integer('participante_id')->unsigned();
            $table->foreign('participante_id')->references('id')->on('participantes');
            $table->integer('trivia_id')->unsigned();
            $table->foreign('trivia_id')->references('id')->on('trivias');
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
        Schema::dropIfExists('puntajes');
    }
}
