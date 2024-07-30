<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('numero_documento');
            $table->date('fecha_registro');
            $table->string('archivo');

            //clave foranea
            $table->unsignedBigInteger('carpeta_cuatro_id');
            $table->foreign('carpeta_cuatro_id')->references('id')->on('carpeta_cuatros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
