<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuestionLike extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','user_id'];

    // question
    public function Question () {
        return $this->belongsTo(Question::class,'question_id');
    }

    // user
    public function user () {
        return $this->hasOne(User::class,'user_id');
    }

}