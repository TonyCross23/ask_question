<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $fillabe = ['slug','name'];

    public function question () {
        return $this->belongsToMany(Question::class,'question_tags');
    }

}