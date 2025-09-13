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
        Schema::create('tarea_archivos', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->unsignedBigInteger('tarea_id');
            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            
            $table->unsignedBigInteger('user_id'); // Usuario que subió el archivo
            $table->foreign('user_id')->references('id')->on('users');
            
            // Datos del archivo
            $table->string('nombre_original'); // Nombre original del archivo
            $table->string('ruta_archivo'); // Ruta donde se almacena el archivo
            $table->string('extension'); // Extensión del archivo (jpg, pdf, docx, etc.)
            $table->string('mime_type'); // Tipo MIME del archivo
            $table->unsignedBigInteger('tamanio'); // Tamaño en bytes
            
            // Metadatos
            $table->text('descripcion')->nullable();
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_archivos');
    }
};
