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
        Schema::create('tblPy1', function (Blueprint $table) {
            $table->id('UserId');
            $table->string('contrasena');
            $table->string('cedula')->unique();
            $table->string('telefono');
            $table->unsignedBigInteger('TipoSangreId');
            $table->foreign('TipoSangreId')->references('TipoSangreId')->on('tblTipoSangre');
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
        Schema::dropIfExists('tblPy1');
    }
};
