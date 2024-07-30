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
        Schema::create('carpeta_cuatros', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('nombre_archivo')->nullable();
            $table->string('numero_archivo')->nullable();
            $table->date('fecha_registro')->nullable();
            $table->string('archivo')->nullable();

            //clave foranea
            $table->unsignedBigInteger('carpeta_tres_id');
            $table->foreign('carpeta_tres_id')->references('id')->on('carpeta_tres')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpeta_cuatros');
    }
};
