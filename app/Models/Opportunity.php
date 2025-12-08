<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    protected $fillable = ['user_id','title','company','category','description','skills_required','budget'];
}
