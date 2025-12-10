<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Course;
use App\Models\Transaction; 
use App\Models\Opportunity; 
use App\Models\Message; 
use App\Models\Contact;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contact> $contacts
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $platformContacts 
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courses
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Course> $courseRecords
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Opportunity> $opportunities
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'title',
        'location',
        'bio',
        'avatar_url',
        'skills',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'skills' => 'array',
    ];

    /* ===========================
    | Relaciones (Chaymba)
    |===========================*/

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
    
    public function platformContacts(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'contacts',
            'user_id',
            'contact_id'
        )->withTimestamps();
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class)
            ->withPivot(['progress', 'completed_at'])
            ->withTimestamps();
    }

    public function courseRecords(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function opportunities(): HasMany
    {
        return $this->hasMany(Opportunity::class);
    }

    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

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