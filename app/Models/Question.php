<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','slug','title','description','is_fiexed'];

    // comment 
    public function comment () {
        return $this->hasMany(QuestionComment::class,'question_id');
    }

    // like
       public function like () {
        return $this->hasMany(QuestionLike::class,'question_id');
    }

    // save
       public function QuestionSave () {
        return $this->hasMany(QuestionSave::class,'question_id');
    }

    // tag
    public function tag () {
        return $this->belongsToMany(Tag::class,'question_tags');
    }

}