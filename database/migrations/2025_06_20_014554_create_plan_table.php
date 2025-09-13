<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('subtitulo');
            $table->decimal('precio', 10, 2);
            $table->enum('moneda', ['BS', 'USD'])->default('BS');
            $table->enum('periodo_facturacion', ['mes', 'trimestre', 'semestre', 'año'])->default('mes');
            $table->integer('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->text('descripcion')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan');
    }
};