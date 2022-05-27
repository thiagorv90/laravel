<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstanciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instancias', function (Blueprint $table) {
            $table->integer('cdInstancia')->primary();
            $table->integer('cdInstituicao');
            $table->string('nmInstancia');
            $table->string('tpFederalDistrital', 1);
            $table->string('tpPublicoPrivado', 1);
            $table->text('dsMandato');
            $table->tinyInteger('stAtivo');
            $table->text('dsObjetivo');
            $table->integer('tpAtribuicoes');
            $table->integer('tpPrioridade');
            $table->integer('cdTema');
            $table->text('dsAmeacas');
            $table->text('dsOportunidades');
            $table->text('dsObservacao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instancias');
    }
}
