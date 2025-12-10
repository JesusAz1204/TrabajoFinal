<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            
            // ⭐ CLAVE FORÁNEA (NECESARIA para la relación HasMany) ⭐
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // ⭐ CORRECCIONES PARA LOS DATOS DEL FORMULARIO ⭐
            $table->string('nombre'); // Cambio de 'title' a 'nombre'
            $table->string('institucion')->nullable(); // Campo nuevo
            $table->date('fecha_inicio')->nullable(); // Campo nuevo
            $table->date('fecha_fin')->nullable(); // Campo nuevo

            // Mantenemos los campos originales (puedes eliminarlos si no se usan):
            $table->string('category')->nullable();
            $table->string('instructor')->nullable();
            $table->string('image_url')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('courses');
    }
};