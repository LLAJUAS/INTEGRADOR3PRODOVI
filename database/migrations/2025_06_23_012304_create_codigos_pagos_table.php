<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigos_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->foreignId('usuario_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('pago_id')->nullable()->constrained('pagos')->nullOnDelete();
            $table->boolean('utilizado')->default(false);
            $table->dateTime('fecha_utilizacion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codigos_pagos');
    }
};