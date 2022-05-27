<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contatos', function (Blueprint $table) {
            $table->integer('cdContato')->primary();
            $table->integer('cdInstancia');
            $table->string('tpContatoRepresentante', 1);
            $table->string('nmContato');
            $table->string('dsEmail');
            $table->string('dsEmailAlternativo');
            $table->tinyInteger('stAtivo');
            
            $table->foreign('cdInstancia', 'PK_INSTANCIA_CONTATO')->references('cdInstancia')->on('instancias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contatos');
    }
}
