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
        Schema::create('preguntas_cuestionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tema_id')->constrained('temas_cuestionario')->onDelete('cascade');
            $table->text('pregunta');
            $table->integer('orden')->default(0);
            $table->enum('tipo_respuesta', ['texto', 'texto_largo', 'numero', 'opcion_multiple', 'checkbox'])->default('texto');
            $table->json('opciones')->nullable(); // Para preguntas de opción múltiple
            $table->boolean('requerido')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preguntas_cuestionario');
    }
};