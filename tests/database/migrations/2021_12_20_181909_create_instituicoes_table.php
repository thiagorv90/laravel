<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->integer('cdIntituicao')->primary();
            $table->integer('cdTipoInstituicao');
            $table->string('nmInstituicao');
            
            $table->foreign('cdTipoInstituicao', 'PK_TIPO_INSTITUICAO')->references('cdTipoInstancia')->on('tipo_instancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instituicoes');
    }
}
