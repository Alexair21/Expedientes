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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_unico')->unique();
            $table->string('estado_proyecto');
            $table->string('responsable_proyecto');
            $table->string('nombre_proyecto');
            $table->string('descripcion');
            $table->string('tipo_formato');
            $table->string('situacion');
            $table->decimal('costo_proyecto', 15, 2);
            $table->decimal('costo_actualizado', 15, 2);
            $table->date('registro_cierre');
            $table->string('archivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
