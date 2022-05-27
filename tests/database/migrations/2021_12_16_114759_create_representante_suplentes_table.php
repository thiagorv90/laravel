<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentanteSuplentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('representante_suplentes', function (Blueprint $table) {
            $table->integer('cdRepSup')->primary();
            $table->string('nmRepresentanteSuplente');
            $table->string('dsEmail');
            $table->string('dsEmailAlternativo');
            $table->tinyInteger('stAtivo');
            $table->string('dsProfissao');
            $table->integer('cdEscolaridade');
            $table->integer('cdEmpresa');
            $table->string('dsEndereco');
            $table->date('dtNascimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('representante_suplentes');
    }
}
