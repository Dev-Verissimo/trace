<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUnidadeEquipamento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->string('tag')->nullable();
            $table->unsignedBigInteger('equipamento_id');
            $table->unsignedBigInteger('local_id');
            $table->string('lote')->nullable();
            $table->string('referencia')->nullable();
            $table->string('numeronf')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->dateTime('data_validade')->nullable();
            $table->dateTime('data_fabricacao')->nullable();
            $table->dateTime('data_compra')->nullable();
            $table->dateTime('data_primeiro_uso')->nullable();
            $table->dateTime('data_ultima_inspecao')->nullable();
            $table->unsignedBigInteger('id_user_ultima_inspecao')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('equipamento_id')
                ->references('id')
                ->on('equipamentos')
                ->onDelete('restrict');

            $table->foreign('local_id')
                ->references('id')
                ->on('locais')
                ->onDelete('restrict');

            $table->foreign('id_user_ultima_inspecao')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('unidades');
    }
}
