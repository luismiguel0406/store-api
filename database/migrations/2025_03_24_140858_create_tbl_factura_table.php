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
        Schema::create('tblFactura', function (Blueprint $table) {
            $table->id('FacturaId');
            $table->unsignedInteger('PedidoId');
            $table->unsignedInteger('ClienteId');
            $table->string('nombreArticulo');
            $table->integer('unidadesCompradas');
            $table->foreign('PedidoId')->references('PedidoId')->on('tblPedido');
            $table->foreign('ClienteId')->references('ClienteId')->on('tblCliente');
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
        Schema::dropIfExists('tblFactura');
    }
};
