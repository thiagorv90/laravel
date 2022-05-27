<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCdRepSupToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->foreignId('cdRepSup')->contrained();
           $table->tinyInteger('admin');
           $table->tinyInteger('operador');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('cdRepSup')->contrained()->onDelete('cascade');
            $table->dropColumn('admin');
           $table->dropColumn('operador');
           
        });
    }
}
