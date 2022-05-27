<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefoneRepresentanteSuplentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefone_representante_suplentes', function (Blueprint $table) {
            $table->integer('cdTelefone')->primary();
            $table->integer('cdRepSup');
            $table->integer('nuDDDTelefone');
            $table->integer('nuTelefone');
            $table->string('tpTelefone', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telefone_representante_suplentes');
    }
}
