<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan_caracteristica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained('plan')->cascadeOnDelete();
            $table->foreignId('caracteristica_id')->constrained('caracteristica')->cascadeOnDelete();
            $table->integer('cantidad')->default(1);
            $table->string('frecuencia')->nullable();
            $table->integer('orden')->default(0);
            $table->boolean('es_destacado')->default(false);
            $table->timestamps();
            
            $table->unique(['plan_id', 'caracteristica_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_caracteristica');
    }
};