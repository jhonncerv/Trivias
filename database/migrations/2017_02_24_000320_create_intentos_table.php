<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('query_ord');
            $table->string('correct_str');
            $table->string('attempt_str')->nullable();
            $table->integer('respuesta_id')->unsigned();
            $table->foreign('respuesta_id')->references('id')->on('respuestas');
            $table->integer('pregunta_id')->unsigned();
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
            $table->integer('puntaje_id')->unsigned();
            $table->foreign('puntaje_id')->references('id')->on('puntajes');
            $table->unique(['respuesta_id', 'puntaje_id', 'pregunta_id']);
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
        Schema::dropIfExists('intentos');
    }
}
