<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableequipSolicitados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equip_solicitados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('solicitacao_id')->nullable();
            $table->unsignedBigInteger('equipamento_id')->nullable();
            $table->string('nome')->nullable();
            $table->integer('quantidade')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('solicitacao_id')
                ->references('id')
                ->on('solicitacoes')
                ->onDelete('restrict');

            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamentos')
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
        Schema::dropIfExists('equip_solicitados');
    }
}
