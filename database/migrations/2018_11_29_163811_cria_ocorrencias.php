<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaOcorrencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('atendimento_id')->unsigned();
            $table->foreign('atendimento_id')->references('id')->on('atendimentos');
            $table->string('atendente');
            $table->integer('causa_id')->unsigned();
            $table->foreign('causa_id')->references('id')->on('causas');
            $table->integer('subcausa_id')->unsigned();
            $table->foreign('subcausa_id')->references('id')->on('sub_causas');
            $table->string('detalhes');
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
        Schema::dropIfExists('Ocorrencias');
    }
}
