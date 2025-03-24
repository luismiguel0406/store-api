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
        Schema::create('tblCliente', function (Blueprint $table) {
            $table->id('ClienteId');
            $table->string('nombre');
            $table->string('telefono');
            $table->unsignedBigInteger('TipoClienteId');
            $table->foreign('TipoClienteId')->references('TipoClienteId')->on('tblTipoCliente');
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
        Schema::dropIfExists('tblCliente');
    }
};
