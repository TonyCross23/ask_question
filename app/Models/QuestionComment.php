<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','user_id','comment'];
    protected $appends = ['date'];

    public function user () {
        return $this->belongsTo(User::class,'user_id');
    }

    public function Question () {
        return $this->belongsTo(Question::class,'question_id');
    }
    
    // date
    public function getDateAttribute () {
        $c = new Carbon($this->created_at);
        return $c->diffForHumans();
    }
}