<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarAtendimentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('tipo_atd_id')->unsigned();
            $table->foreign('tipo_atd_id')->references('id')->on('tipo_atds');
            $table->string('atendente');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->string('descricao');
            $table->integer('prioridade_id')->unsigned();
            $table->foreign('prioridade_id')->references('id')->on('prioridades');
            $table->integer('causa_id')->unsigned();
            $table->foreign('causa_id')->references('id')->on('causas');
            $table->integer('subcausa_id')->unsigned();
            $table->foreign('subcausa_id')->references('id')->on('sub_causas');
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
        //
    }
}
