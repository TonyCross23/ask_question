<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\QuestionLike;
use Illuminate\Http\Request;
use App\Models\QuestionComment;
use App\Models\QuestionSave;
use Illuminate\Support\Facades\Auth;
use App\Traits\Question as QuestionTrait;
use Illuminate\Contracts\Database\Eloquent\Builder;

class QuestionController extends Controller
{
    use QuestionTrait;
     //home vue 
    public function home (Request $request) {

        if($slug = $request->tag) {
            $tag = Tag::where('slug',$slug)->first();
            $questions = $tag->question()->with('comment','tag','questionsave')->orderBy('id','DESC')->paginate(10);
        }elseif($type = $request->type){
            if($type == 'answer'){
                $questions = Question::whereHas('comment',function(Builder $q){
                    $q->where('user_id',Auth::user()->id);
                })->with('comment','tag','questionsave')->orderBy('id','DESC')->paginate(10);
            }
            if($type == 'unanswer'){
                $questions = Question::Has('comment','<',1)->with('comment','tag','questionsave')->orderBy('id','DESC')->paginate(10);
            }
        }else{

            $questions = Question::with('comment','tag','questionsave')->orderBy('id','DESC')->paginate(10);
        }

        foreach ($questions as $k=>$v) {
            $questions[$k]->is_like = $this->getLikeDetail($v->id)['is_like'];
            $questions[$k]->like_count = $this->getLikeDetail($v->id)['like_count'];
            $questions[$k]->is_save = $this->isSave($v->id);
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

    // create question
    public function create () {
        return Inertia::render('QuestionCreate');
    }

    // store question 
    public function store(Request $request){
        
      $dec = $request->description;
      $title = $request->title;
      $tag = $request->tag;
      $tag_arr = explode(',',$tag);

      $created_q = Question::create([
        'user_id' => Auth::user()->id,
        'title' => $title,
        'slug' =>Str::slug($title),
        'description' => $dec,
      ]);

      $q = Question::find($created_q->id);
      
      $q->tag()->attach($tag_arr);

 

        return redirect()->route('home')->with('success','Create Succefully');
    }

    //question detail
    public function detail ($slug) {

        $question = Question::where('slug',$slug)->with('like','comment.user','tag')->first();
        $question->is_like = $this->getLikeDetail($question->id)['is_like'];
        $question->like_count = $this->getLikeDetail($question->id)['like_count'];
        return Inertia::render('QuestionDetail',['question' => $question]);
    }

    // comment create
    public function createComment (Request $request) {
     
        $q_id = $request->question_id;
        $comment = $request->comment;

        $cmt = QuestionComment::create([
            'question_id' => $q_id,
            'user_id' => Auth::user()->id,
            'comment' => $comment,
        ]);

        $createComment = QuestionComment::where('id',$cmt->id)->with('user')->first();

        return['success'=>true,'comment'=>$createComment];
    }

    // user question
    public function userQuestion () {
        $user_id = Auth::user()->id;

        $questions = Question::where('user_id',$user_id)->paginate(2);

        return Inertia::render('UserQuestion',['questions'=>$questions]);

    }

    // question delete
    public function questionDelete ($id) {
        Question::where('id',$id)->delete();

        return response()->json(['success' => true]);
    }

    // question save
    public function saveQuestion () {
        $q_id = request()->question_id;
        $user_id = Auth::user()->id;

        QuestionSave::create([
            'question_id' => $q_id,
            'user_id' => $user_id,
        ]);
        return response()->json(['success'=>true]);
    }

    // question fix
    public function setFix () {
        $id = request()->id;
        
        Question::where('id',$id)->update([
            'is_fixed' => 'true',
        ]);

        return response()->json(['success' => true]);
    }

    public function showSaveQuestion (){

        $questions = QuestionSave::where('user_id',Auth::user()->id)->with('question')->get();
     
        return Inertia::render('SaveQuestion',['questions' => $questions]);
    }
}