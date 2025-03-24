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
        Schema::create('tblArticuloColocacion', function (Blueprint $table) {
            $table->id('ArticuloColocacionId');
            $table->unsignedBigInteger('ArticuloId');
            $table->unsignedBigInteger('ColocacionId');
            $table->string('nombreArticulo');
            $table->float('precioArticulo');
            $table->foreign('ArticuloId')->references('ArticuloId')->on('tblArticulo');
            $table->foreign('ColocacionId')->references('ColocacionId')->on('tblColocacion');
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
        Schema::dropIfExists('tblArticuloColocacion');
    }
};
