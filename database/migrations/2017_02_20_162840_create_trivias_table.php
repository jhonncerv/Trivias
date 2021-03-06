<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriviasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trivias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('game');
            $table->boolean('available');
            $table->integer('points_per_anwser');
            $table->integer('time_limit');
            $table->integer('query_size');
            $table->timestamp('publish')->nullable();
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
        Schema::dropIfExists('trivias');
    }
}
