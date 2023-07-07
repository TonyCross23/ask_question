<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Question;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;

class QuestionController extends Controller
{
    use QuestionTrait;
     //home vue 
    public function home () {
        $questions = Question::with('comment','tag','questionsave')->get();
        foreach ($questions as $k=>$v) {
            $questions[$k]->is_like = $this->getLikeDetail($v->id)['is_like'];
            $questions[$k]->like_count = $this->getLikeDetail($v->id)['like_count'];
        }
       
        return Inertia::render('Home',['questions'=>$questions]);
    }

    // like
    public function like ($id){

     QuestionLike::create([
        'user_id' => Auth::user()->id,
        'question_id' => $id,
     ]);
 
        return response()->json(['success' => true]);
    }


    //question detail
    public function detail ($slug) {

        $question = Question::where('slug',$slug)->with('like','comment.user','tag')->first();
        $question->is_like = $this->getLikeDetail($question->id)['is_like'];
        $question->like_count = $this->getLikeDetail($question->id)['like_count'];
        return Inertia::render('QuestionDetail',['question' => $question]);
    }
}