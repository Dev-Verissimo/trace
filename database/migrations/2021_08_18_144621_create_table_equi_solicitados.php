<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEquiSolicitados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equi_solicitados_despacho', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('despacho_id')->nullable();
            $table->unsignedBigInteger('unidade_id')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('despacho_id')
                ->references('id')
                ->on('despachos')
                ->onDelete('restrict');

            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equi_solicitados_despacho');
    }
}
