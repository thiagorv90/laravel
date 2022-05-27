<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefoneContatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefone_contatos', function (Blueprint $table) {
            $table->integer('cdTelefone')->primary();
            $table->integer('cdContatoTelefone');
            $table->integer('nuDDDTelefone');
            $table->integer('nuTelefone');
            
            $table->foreign('cdContatoTelefone', 'PK_CONTATO_TELEFONE')->references('cdContato')->on('contatos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefone_contatos');
    }
}
