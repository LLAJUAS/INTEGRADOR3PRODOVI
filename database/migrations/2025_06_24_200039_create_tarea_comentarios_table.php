<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaComentariosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarea_comentarios', function (Blueprint $table) {
            $table->id();
            
            // Relación polimórfica (puede ser Tarea o TareaArchivo)
            $table->unsignedBigInteger('comentable_id');
            $table->string('comentable_type'); // 'App\Models\Tarea' o 'App\Models\TareaArchivo'
            
            // Usuario que hizo el comentario
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Texto del comentario
            $table->text('contenido');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_comentarios');
    }
}
