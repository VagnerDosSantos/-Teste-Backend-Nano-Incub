<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaMovimentacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function(Blueprint $table) {
            $table->id();
            $table->enum('tipo_movimentacao', ['entrada', 'saida']);
            $table->unsignedDecimal('valor');
            $table->string('observacao');
            $table->foreignId('funcionario_id')->references('id')->on('funcionarios');
            $table->foreignId('administrador_id')->references('id')->on('administradores');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimentacoes');
    }
}
