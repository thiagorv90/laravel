<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representacoes', function (Blueprint $table) {
            $table->integer('cdRepresentacao')->primary();
            $table->integer('cdInstancia');
            $table->integer('cdTitular');
            $table->integer('cdSuplente');
            $table->date('dtInicioVigencia');
            $table->date('dtFimVigencia');
            $table->text('dsDesignacao');
            $table->text('dsNomeacao');
            $table->tinyInteger('stAtivo');
            
            $table->foreign('cdInstancia', 'PK_INSTANCIA')->references('cdInstancia')->on('instancias');
            $table->foreign('cdSuplente', 'PK_SUPLENTE')->references('cdRepSup')->on('representante_suplentes');
            $table->foreign('cdTitular', 'PK_TITULAR')->references('cdRepSup')->on('representante_suplentes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representacoes');
    }
}
