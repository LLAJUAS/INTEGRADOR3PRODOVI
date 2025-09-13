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
      
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('suscripcion_id')->constrained('suscripciones');
            $table->foreignId('plan_id')->constrained('plan');
            
            // Información del pago
            $table->string('codigo_pago')->unique()->nullable();
            $table->decimal('monto', 10, 2);
            $table->enum('moneda', ['BS', 'USD'])->default('BS');
            $table->enum('metodo', ['qr', 'fisico']);
            $table->enum('estado', ['pendiente', 'completado', 'rechazado'])->default('pendiente');
            
            // Auditoría
            $table->foreignId('aprobado_por')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('fecha_aprobacion')->nullable();
            $table->timestamp('fecha_pago')->nullable();
            
            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['codigo_pago', 'estado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
