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
        Schema::create('respuestas_cuestionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            $table->foreignId('pregunta_id')->constrained('preguntas_cuestionario')->onDelete('cascade');
            $table->text('respuesta');
            $table->timestamps();
            $table->softDeletes();
            
            // Aseguramos que no haya respuestas duplicadas para la misma pregunta y empresa
            $table->unique(['empresa_id', 'pregunta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas_cuestionario');
    }
};