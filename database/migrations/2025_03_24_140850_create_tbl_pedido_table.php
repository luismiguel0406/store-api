<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tblPedido', function (Blueprint $table) {
            $table->id('PedidoId');
            $table->unsignedBigInteger('ClienteId');
            $table->unsignedBigInteger('ArticuloColocacionId');
            $table->foreign('ClienteId')->references('ClienteId')->on('tblCliente');
            $table->foreign('ArticuloColocacionId')->references('ArticuloColocacionId')->on('tblArticuloColocacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tblPedido');
    }
};
