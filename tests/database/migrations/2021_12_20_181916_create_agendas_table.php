<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendas', function (Blueprint $table) {
            $table->integer('cdAgenda')->primary();
            $table->integer('cdRepresentacao');
            $table->date('dtAgenda');
            $table->time('hrAgenda');
            $table->tinyInteger('stAgenda');
            $table->string('dsLocal');
            $table->text('dsPauta');
            $table->text('dsResumo');
            $table->tinyInteger('stSuplente');
            
            $table->foreign('cdRepresentacao', 'PK_REPRESENTACAO')->references('cdRepresentacao')->on('representacoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendas');
    }
}
