<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nombre',       // <-- Usado en el formulario
        'institucion',  // <-- Usado en el formulario
        'fecha_inicio', // <-- Usado en el formulario
        'fecha_fin',    // <-- Usado en el formulario
        
        // Si mantuviste los campos de la migración original, añádelos también
        'category',
        'instructor',
        'image_url',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}