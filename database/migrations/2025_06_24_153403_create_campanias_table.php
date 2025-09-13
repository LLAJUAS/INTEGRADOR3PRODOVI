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
        Schema::create('campanias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100); 
            $table->text('descripcion');
            $table->date('fecha_inicio'); 
            $table->date('fecha_fin');
            $table->enum('estado', ['activa', 'pausada', 'finalizada'])->default('activa');
            
            // Usuario que crea la campaña (admin)
            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('id')->on('users');
            
            // Usuario al que se delega la campaña (community manager)
            $table->unsignedBigInteger('community_manager_id');
            $table->foreign('community_manager_id')->references('id')->on('users');
            
            // Cliente dueño de la campaña (usuario que pagó la suscripción)
            $table->unsignedBigInteger('usuario_cliente_id');
            $table->foreign('usuario_cliente_id')->references('id')->on('users');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campanias');
    }
};
