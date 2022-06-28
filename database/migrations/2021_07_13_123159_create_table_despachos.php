<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDespachos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despachos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('localDestino_id')->nullable();
            $table->unsignedBigInteger('userRequest_id')->nullable();
            $table->unsignedBigInteger('userSend_id')->nullable();
            $table->unsignedBigInteger('solicitacao_id')->nullable();
            $table->text('mensagem')->nullable();
            $table->integer('status')->nullable();

            $table->foreign('localDestino_id')
                ->references('id')
                ->on('locais')
                ->onDelete('restrict');

            $table->foreign('userRequest_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('userSend_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('solicitacao_id')
                ->references('id')
                ->on('solicitacoes')
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
        Schema::dropIfExists('despachos');
    }
}
