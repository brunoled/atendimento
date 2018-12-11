<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table){
            $table->increments('id');
            $table->string('nome');
            $table->string('endereco')->nullable();
            $table->string('num_end')->nullable();
            $table->string('bairro_end')->nullable();
            $table->string('cidade_end')->nullable();
            $table->string('cep_end')->nullable();
            $table->string('telefone')->nullable();
            $table->string('telefax')->nullable();
            $table->string('celular')->nullable();
            $table->string('cnpj_cpf')->nullable();
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
