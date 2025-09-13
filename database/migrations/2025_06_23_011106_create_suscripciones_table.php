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
      
        Schema::create('suscripciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plan');
            $table->enum('estado', ['activa', 'pendiente', 'cancelada', 'finalizada'])->default('pendiente');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->dateTime('fecha_cancelacion')->nullable();
            $table->enum('metodo_pago', ['qr', 'fisico'])->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suscripciones');
    }
};
