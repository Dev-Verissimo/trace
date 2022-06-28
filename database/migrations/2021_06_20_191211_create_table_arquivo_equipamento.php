<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableArquivoEquipamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamento_arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->text('descricao')->nullable();
            $table->string('path_arquivo')->nullable();

            $table->unsignedBigInteger('equipamento_id');
            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('restrict');

            $table->timestamps();
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
        Schema::dropIfExists('equipamento_arquivos');
    }
}
