<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            
            // ⭐ COLUMNA CRUCIAL 1: user_id para la relación HasMany ⭐
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // ⭐ COLUMNA CRUCIAL 2: 'name' (la que está causando el error 1054) ⭐
            $table->string('name'); 
            
            // Otros campos del formulario
            $table->string('phone', 20)->nullable(); 
            $table->string('email')->nullable(); 
            $table->string('company')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};