<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',

        // Campos extra (Chaymba)
        'title',
        'location',
        'bio',
        'avatar_url',
        'skills',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        // Skills se guarda como JSON (array)
        'skills' => 'array',
    ];

    /* ===========================
     | Relaciones (Chaymba)
     |===========================*/

    /**
     * Mis contactos (relación many-to-many consigo mismo).
     * Tabla: contacts (user_id, contact_id)
     */
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'contacts',
            'user_id',
            'contact_id'
        )->withTimestamps();
    }

    /**
     * Cursos inscritos (many-to-many).
     * Tabla pivot: course_user (user_id, course_id, progress, completed_at)
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withPivot(['progress', 'completed_at'])
            ->withTimestamps();
    }

    /**
     * Transacciones del usuario.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Oportunidades publicadas por el usuario.
     */
    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    /**
     * Mensajes enviados por el usuario.
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    /**
     * Mensajes recibidos por el usuario.
     */
    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Conversación con otro usuario (helper).
     * Uso: auth()->user()->conversationWith($userId)->get();
     */
    public function conversationWith(int $otherUserId)
    {
        return Message::query()
            ->where(function ($q) use ($otherUserId) {
                $q->where('sender_id', $this->id)
                  ->where('receiver_id', $otherUserId);
            })
            ->orWhere(function ($q) use ($otherUserId) {
                $q->where('sender_id', $otherUserId)
                  ->where('receiver_id', $this->id);
            })
            ->orderBy('created_at');
    }
}
