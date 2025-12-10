<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('nombre'); 
            $table->string('institucion')->nullable(); 
            $table->date('fecha_inicio')->nullable(); 
            $table->date('fecha_fin')->nullable(); 

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