<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEquipamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('fabricante_id')->nullable();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->string('modelo')->nullable();
            $table->string('fornecedor')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onDelete('restrict');

            $table->foreign('fabricante_id')
                ->references('id')
                ->on('fabricantes')
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
        Schema::dropIfExists('equipamentos');
    }
}
