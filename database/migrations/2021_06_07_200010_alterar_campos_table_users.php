<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterarCamposTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->string('profissao')->nullable();
            $table->boolean('status')->nullable();
            $table->string('imagem')->nullable();
            $table->softDeletes();
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
            $table->removeColumn('telefone');
            $table->removeColumn('endereco');
            $table->removeColumn('profissao');
            $table->removeColumn('status');

        });
    }
}
