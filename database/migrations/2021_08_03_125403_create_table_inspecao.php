<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInspecao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspecoes', function (Blueprint $table) {
            $table->id();
            $table->text("observacao")->nullable();
            $table->date("data_inspecao")->nullable();
            $table->integer("status")->nullable();
            $table->string("imagem")->nullable();
            $table->integer("tipo")->nullable();

            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("local_id")->nullable();
            $table->unsignedBigInteger("unidade_id")->nullable();
            $table->unsignedBigInteger('local_anterior_id')->nullable();
            $table->unsignedBigInteger("depacho_id")->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('local_id')
                ->references('id')
                ->on('locais')
                ->onDelete('restrict');

            $table->foreign('unidade_id')
                ->references('id')
                ->on('unidades')
                ->onDelete('restrict');

            $table->foreign('local_anterior_id')
                ->references('id')
                ->on('locais')
                ->onDelete('restrict');

            $table->foreign('depacho_id')
                ->references('id')
                ->on('despachos')
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
        Schema::dropIfExists('inspecoes');
    }
}
