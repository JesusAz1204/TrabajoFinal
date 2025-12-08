<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id','occurred_at','description','amount','status'];
    protected $casts = ['occurred_at' => 'date'];
}
