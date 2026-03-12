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
        Schema::create('planes_marketing', function (Blueprint $table) {
            $table->id();
            
            // Clave foránea a la empresa
            $table->foreignId('empresa_id')->constrained('empresas')->onDelete('cascade');
            
            // Clave foránea a la suscripción que generó este plan
            $table->foreignId('suscripcion_id')->constrained('suscripciones')->onDelete('cascade');
            
            // El contenido del plan, que será largo
            $table->longText('contenido');
            
            // Estado del plan (borrador, activo, etc.)
            $table->enum('estado', ['borrador', 'activo', 'archivado'])->default('borrador');
            
            // Fechas de creación y actualización
            $table->timestamps();
            
            // Soft Deletes para no perder el historial
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes_marketing');
    }
};